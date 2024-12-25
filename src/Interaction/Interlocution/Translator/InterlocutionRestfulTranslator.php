<?php
namespace Sdk\Interaction\Interlocution\Translator;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\Interlocution\Model\Interlocution;
use Sdk\Interaction\Interlocution\Model\NullInterlocution;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionRestfulTranslatorTrait;

class InterlocutionRestfulTranslator implements IRestfulTranslator
{
    use CommonInteractionRestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $interlocution = null)
    {
        if (empty($expression)) {
            return NullInterlocution::getInstance();
        }

        if ($interlocution == null) {
            $interlocution = new Interlocution();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        
        $interlocution = $this->arrayToObjectCommon($interlocution, $expression);
        
        if (isset($attributes['question'])) {
            $interlocution->setQuestion($attributes['question']);
        }

        return $interlocution;
    }

    public function objectToArray($interlocution, array $keys = array())
    {
        if (!$interlocution instanceof Interlocution) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'realName',
                'cellphone',
                'email',
                'question',
                'member',
                'replyContent',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'interlocutions'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $interlocution->getId();
        }

        $expression = $this->objectToArrayCommon($interlocution, $keys, $expression);

        if (in_array('question', $keys)) {
            $expression['data']['attributes']['question'] = $interlocution->getQuestion();
        }

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }

        return $expression;
    }
}

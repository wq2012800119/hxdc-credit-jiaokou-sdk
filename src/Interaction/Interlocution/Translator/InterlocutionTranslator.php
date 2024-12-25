<?php
namespace Sdk\Interaction\Interlocution\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionTranslatorTrait;

use Sdk\Interaction\Interlocution\Model\Interlocution;
use Sdk\Interaction\Interlocution\Model\NullInterlocution;

class InterlocutionTranslator implements ITranslator
{
    use CommonInteractionTranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullInterlocution::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'replyStatus',
                'replyTime',
                'replyContent',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'member' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = $this->objectToArrayCommon($interlocution, $keys);

        if (in_array('question', $keys)) {
            $expression['question'] = $interlocution->getQuestion();
        }

        return $expression;
    }
}

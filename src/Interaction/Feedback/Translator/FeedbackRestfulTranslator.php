<?php
namespace Sdk\Interaction\Feedback\Translator;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Interaction\Feedback\Model\Feedback;
use Sdk\Interaction\Feedback\Model\NullFeedback;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionRestfulTranslatorTrait;

class FeedbackRestfulTranslator implements IRestfulTranslator
{
    use CommonInteractionRestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $feedback = null)
    {
        if (empty($expression)) {
            return NullFeedback::getInstance();
        }

        if ($feedback == null) {
            $feedback = new Feedback();
        }
       
        $feedback = $this->arrayToObjectCommon($feedback, $expression);
        
        return $feedback;
    }

    public function objectToArray($feedback, array $keys = array())
    {
        if (!$feedback instanceof Feedback) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'realName',
                'cellphone',
                'email',
                'title',
                'content',
                'member',
                'replyContent',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'feedbacks'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $feedback->getId();
        }

        $expression = $this->objectToArrayCommon($feedback, $keys, $expression);

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }

        return $expression;
    }
}

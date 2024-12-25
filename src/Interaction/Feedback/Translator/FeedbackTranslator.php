<?php
namespace Sdk\Interaction\Feedback\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;

use Sdk\Interaction\CommonInteraction\Translator\CommonInteractionTranslatorTrait;

use Sdk\Interaction\Feedback\Model\Feedback;
use Sdk\Interaction\Feedback\Model\NullFeedback;

class FeedbackTranslator implements ITranslator
{
    use CommonInteractionTranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullFeedback::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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

        $expression = $this->objectToArrayCommon($feedback, $keys);

        return $expression;
    }
}

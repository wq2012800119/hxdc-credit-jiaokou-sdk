<?php
namespace Sdk\Interaction\CommonInteraction\Translator;

use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\User\Member\Translator\MemberTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

trait CommonInteractionTranslatorTrait
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArrayCommon(CommonInteraction $commonInteraction, array $keys)
    {
        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($commonInteraction->getId());
        }
        if (in_array('realName', $keys)) {
            $expression['realName'] = $commonInteraction->getRealName();
        }
        if (in_array('cellphone', $keys)) {
            $expression['cellphone'] = $commonInteraction->getCellphone();
        }
        if (in_array('email', $keys)) {
            $expression['email'] = $commonInteraction->getEmail();
        }
        if (in_array('title', $keys)) {
            $expression['title'] = $commonInteraction->getTitle();
        }
        if (in_array('content', $keys)) {
            $expression['content'] = $commonInteraction->getContent();
        }
        if (in_array('replyStatus', $keys)) {
            $expression['replyStatus'] = $this->typeFormatConversion(
                $commonInteraction->getReplyStatus(),
                CommonInteraction::REPLY_STATUS_CN
            );
        }
        if (in_array('replyTime', $keys)) {
            $replyTime = $commonInteraction->getReplyTime();
            $expression['replyTime'] = $replyTime;
            $expression['replyTimeFormatConvert'] = !empty($replyTime) ? date('Y-m-d', $replyTime) : '';
        }
        if (in_array('replyContent', $keys)) {
            $expression['replyContent'] = $commonInteraction->getReplyContent();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $commonInteraction->getStatus();
        }

        $expression = $this->relationObjectToArray($commonInteraction, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $commonInteraction->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d', $commonInteraction->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $commonInteraction->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $commonInteraction->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(
        CommonInteraction $commonInteraction,
        array $keys,
        array $expression
    ) : array {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $commonInteraction->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $commonInteraction->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $commonInteraction->getMember(),
                $keys['member']
            );
        }
        
        return $expression;
    }
}

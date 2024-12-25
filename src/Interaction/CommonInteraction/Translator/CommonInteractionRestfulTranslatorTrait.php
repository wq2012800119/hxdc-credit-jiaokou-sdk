<?php
namespace Sdk\Interaction\CommonInteraction\Translator;

use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Member\Translator\MemberRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
trait CommonInteractionRestfulTranslatorTrait
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObjectCommon(CommonInteraction $commonInteraction, array $expression)
    {
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $commonInteraction->setId($data['id']);
        }
        if (isset($attributes['realName'])) {
            $commonInteraction->setRealName($attributes['realName']);
        }
        if (isset($attributes['cellphone'])) {
            $commonInteraction->setCellphone($attributes['cellphone']);
        }
        if (isset($attributes['email'])) {
            $commonInteraction->setEmail($attributes['email']);
        }
        if (isset($attributes['title'])) {
            $commonInteraction->setTitle($attributes['title']);
        }
        if (isset($attributes['content'])) {
            $commonInteraction->setContent($attributes['content']);
        }
        if (isset($attributes['replyStatus'])) {
            $commonInteraction->setReplyStatus($attributes['replyStatus']);
        }
        if (isset($attributes['replyTime'])) {
            $commonInteraction->setReplyTime($attributes['replyTime']);
        }
        if (isset($attributes['replyContent'])) {
            $commonInteraction->setReplyContent($attributes['replyContent']);
        }
        if (isset($attributes['status'])) {
            $commonInteraction->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $commonInteraction->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $commonInteraction->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $commonInteraction->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $commonInteraction->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $commonInteraction->setStaff($staff);
        }
        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $commonInteraction->setMember($member);
        }
        
        return $commonInteraction;
    }

    public function objectToArrayCommon(CommonInteraction $commonInteraction, array $keys, array $expression)
    {
        $attributes = array();

        if (in_array('realName', $keys)) {
            $attributes['realName'] = $commonInteraction->getRealName();
        }
        if (in_array('cellphone', $keys)) {
            $attributes['cellphone'] = $commonInteraction->getCellphone();
        }
        if (in_array('email', $keys)) {
            $attributes['email'] = $commonInteraction->getEmail();
        }
        if (in_array('title', $keys)) {
            $attributes['title'] = $commonInteraction->getTitle();
        }
        if (in_array('content', $keys)) {
            $attributes['content'] = $commonInteraction->getContent();
        }
        if (in_array('replyContent', $keys)) {
            $attributes['replyContent'] = $commonInteraction->getReplyContent();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($commonInteraction->getStaff()->getId())
            );
        }
        
        if (in_array('member', $keys)) {
            $expression['data']['relationships']['member']['data'] = array(
                'type' => 'members',
                'id' => strval($commonInteraction->getMember()->getId())
            );
        }
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($commonInteraction->getOrganization()->getId())
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\Rap\Memorandum\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Rap\Memorandum\Model\Memorandum;
use Sdk\Rap\Memorandum\Model\NullMemorandum;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class MemorandumRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $memorandum = null)
    {
        if (empty($expression)) {
            return NullMemorandum::getInstance();
        }

        if ($memorandum == null) {
            $memorandum = new Memorandum();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $memorandum->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $memorandum->setName($attributes['name']);
        }
        if (isset($attributes['documentNo'])) {
            $memorandum->setDocumentNo($attributes['documentNo']);
        }
        if (isset($attributes['originatingUnit'])) {
            $memorandum->setOriginatingUnit($attributes['originatingUnit']);
        }
        if (isset($attributes['releaseDate'])) {
            $memorandum->setReleaseDate($attributes['releaseDate']);
        }
        if (isset($attributes['rewardType'])) {
            $memorandum->setRewardType($attributes['rewardType']);
        }
        if (isset($attributes['jointSigningDepartment'])) {
            $memorandum->setJointSigningDepartment($attributes['jointSigningDepartment']);
        }
        if (isset($attributes['content'])) {
            $memorandum->setContent($attributes['content']);
        }
        if (isset($attributes['attachments'])) {
            $memorandum->setAttachments($attributes['attachments']);
        }
        if (isset($attributes['status'])) {
            $memorandum->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $memorandum->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $memorandum->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $memorandum->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $memorandum->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $memorandum->setStaff($staff);
        }
        
        return $memorandum;
    }

    public function objectToArray($memorandum, array $keys = array())
    {
        if (!$memorandum instanceof Memorandum) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'documentNo',
                'originatingUnit',
                'releaseDate',
                'rewardType',
                'jointSigningDepartment',
                'content',
                'liabilityBreachMemorandum',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'memorandums'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $memorandum->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $memorandum->getName();
        }
        if (in_array('documentNo', $keys)) {
            $attributes['documentNo'] = $memorandum->getDocumentNo();
        }
        if (in_array('originatingUnit', $keys)) {
            $attributes['originatingUnit'] = $memorandum->getOriginatingUnit();
        }
        if (in_array('releaseDate', $keys)) {
            $attributes['releaseDate'] = $memorandum->getReleaseDate();
        }
        if (in_array('rewardType', $keys)) {
            $attributes['rewardType'] = $memorandum->getRewardType();
        }
        if (in_array('jointSigningDepartment', $keys)) {
            $attributes['jointSigningDepartment'] = $memorandum->getJointSigningDepartment();
        }
        if (in_array('content', $keys)) {
            $attributes['content'] = $memorandum->getContent();
        }
        if (in_array('attachments', $keys)) {
            $attributes['attachments'] = $memorandum->getAttachments();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($memorandum->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}

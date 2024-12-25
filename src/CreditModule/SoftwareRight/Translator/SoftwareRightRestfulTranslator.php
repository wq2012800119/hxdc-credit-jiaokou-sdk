<?php
namespace Sdk\CreditModule\SoftwareRight\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\SoftwareRight\Model\SoftwareRight;
use Sdk\CreditModule\SoftwareRight\Model\NullSoftwareRight;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class SoftwareRightRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $softwareRight = null)
    {
        if (empty($expression)) {
            return NullSoftwareRight::getInstance();
        }

        if ($softwareRight == null) {
            $softwareRight = new SoftwareRight();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $softwareRight->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $softwareRight->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $softwareRight->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['title'])) {
            $softwareRight->setTitle($attributes['title']);
        }
        if (isset($attributes['version'])) {
            $softwareRight->setVersion($attributes['version']);
        }
        if (isset($attributes['category'])) {
            $softwareRight->setCategory($attributes['category']);
        }
        if (isset($attributes['registrationNumber'])) {
            $softwareRight->setRegistrationNumber($attributes['registrationNumber']);
        }
        if (isset($attributes['registrationApprovalDate'])) {
            $softwareRight->setRegistrationApprovalDate($attributes['registrationApprovalDate']);
        }
        if (isset($attributes['status'])) {
            $softwareRight->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $softwareRight->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $softwareRight->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $softwareRight->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $softwareRight->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $softwareRight->setStaff($staff);
        }
        
        return $softwareRight;
    }

    public function objectToArray($softwareRight, array $keys = array())
    {
        if (!$softwareRight instanceof SoftwareRight) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'title',
                'version',
                'category',
                'registrationNumber',
                'registrationApprovalDate',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'softwareRights'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $softwareRight->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $softwareRight->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $softwareRight->getUnifiedIdentifier();
        }
        if (in_array('title', $keys)) {
            $attributes['title'] = $softwareRight->getTitle();
        }
        if (in_array('version', $keys)) {
            $attributes['version'] = $softwareRight->getVersion();
        }
        if (in_array('category', $keys)) {
            $attributes['category'] = $softwareRight->getCategory();
        }
        if (in_array('registrationNumber', $keys)) {
            $attributes['registrationNumber'] = $softwareRight->getRegistrationNumber();
        }
        if (in_array('registrationApprovalDate', $keys)) {
            $attributes['registrationApprovalDate'] = $softwareRight->getRegistrationApprovalDate();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($softwareRight->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($softwareRight->getStaff()->getId())
            );
        }

        return $expression;
    }
}

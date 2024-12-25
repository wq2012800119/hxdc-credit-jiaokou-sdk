<?php
namespace Sdk\CreditModule\Copyright\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\Copyright\Model\Copyright;
use Sdk\CreditModule\Copyright\Model\NullCopyright;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CopyrightRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $copyright = null)
    {
        if (empty($expression)) {
            return NullCopyright::getInstance();
        }

        if ($copyright == null) {
            $copyright = new Copyright();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $copyright->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $copyright->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $copyright->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['title'])) {
            $copyright->setTitle($attributes['title']);
        }
        if (isset($attributes['registrationNumber'])) {
            $copyright->setRegistrationNumber($attributes['registrationNumber']);
        }
        if (isset($attributes['conditions'])) {
            $copyright->setConditions($attributes['conditions']);
        }
        if (isset($attributes['registrationDate'])) {
            $copyright->setRegistrationDate($attributes['registrationDate']);
        }
        if (isset($attributes['status'])) {
            $copyright->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $copyright->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $copyright->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $copyright->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $copyright->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $copyright->setStaff($staff);
        }
        
        return $copyright;
    }

    public function objectToArray($copyright, array $keys = array())
    {
        if (!$copyright instanceof Copyright) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'title',
                'registrationNumber',
                'conditions',
                'registrationDate',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'copyrights'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $copyright->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $copyright->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $copyright->getUnifiedIdentifier();
        }
        if (in_array('title', $keys)) {
            $attributes['title'] = $copyright->getTitle();
        }
        if (in_array('registrationNumber', $keys)) {
            $attributes['registrationNumber'] = $copyright->getRegistrationNumber();
        }
        if (in_array('conditions', $keys)) {
            $attributes['conditions'] = $copyright->getConditions();
        }
        if (in_array('registrationDate', $keys)) {
            $attributes['registrationDate'] = $copyright->getRegistrationDate();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($copyright->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($copyright->getStaff()->getId())
            );
        }

        return $expression;
    }
}

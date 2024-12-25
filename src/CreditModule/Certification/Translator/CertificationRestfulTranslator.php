<?php
namespace Sdk\CreditModule\Certification\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\Certification\Model\Certification;
use Sdk\CreditModule\Certification\Model\NullCertification;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CertificationRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $certification = null)
    {
        if (empty($expression)) {
            return NullCertification::getInstance();
        }

        if ($certification == null) {
            $certification = new Certification();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $certification->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $certification->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $certification->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['name'])) {
            $certification->setName($attributes['name']);
        }
        if (isset($attributes['pubDate'])) {
            $certification->setPubDate($attributes['pubDate']);
        }
        if (isset($attributes['validateDate'])) {
            $certification->setValidateDate($attributes['validateDate']);
        }
        if (isset($attributes['status'])) {
            $certification->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $certification->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $certification->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $certification->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $certification->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $certification->setStaff($staff);
        }
        
        return $certification;
    }

    public function objectToArray($certification, array $keys = array())
    {
        if (!$certification instanceof Certification) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'name',
                'pubDate',
                'validateDate',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'certifications'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $certification->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $certification->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $certification->getUnifiedIdentifier();
        }
        if (in_array('name', $keys)) {
            $attributes['name'] = $certification->getName();
        }
        if (in_array('pubDate', $keys)) {
            $attributes['pubDate'] = $certification->getPubDate();
        }
        if (in_array('validateDate', $keys)) {
            $attributes['validateDate'] = $certification->getValidateDate();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($certification->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($certification->getStaff()->getId())
            );
        }

        return $expression;
    }
}

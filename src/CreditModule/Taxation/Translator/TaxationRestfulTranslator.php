<?php
namespace Sdk\CreditModule\Taxation\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\Taxation\Model\Taxation;
use Sdk\CreditModule\Taxation\Model\NullTaxation;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class TaxationRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $taxation = null)
    {
        if (empty($expression)) {
            return NullTaxation::getInstance();
        }

        if ($taxation == null) {
            $taxation = new Taxation();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $taxation->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $taxation->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $taxation->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['identificationNumber'])) {
            $taxation->setIdentificationNumber($attributes['identificationNumber']);
        }
        if (isset($attributes['outstandingTaxBalance'])) {
            $taxation->setOutstandingTaxBalance($attributes['outstandingTaxBalance']);
        }
        if (isset($attributes['totalTaxAmount'])) {
            $taxation->setTotalTaxAmount($attributes['totalTaxAmount']);
        }
        if (isset($attributes['status'])) {
            $taxation->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $taxation->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $taxation->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $taxation->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $taxation->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $taxation->setStaff($staff);
        }
        
        return $taxation;
    }

    public function objectToArray($taxation, array $keys = array())
    {
        if (!$taxation instanceof Taxation) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'identificationNumber',
                'outstandingTaxBalance',
                'totalTaxAmount',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'taxation'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $taxation->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $taxation->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $taxation->getUnifiedIdentifier();
        }
        if (in_array('identificationNumber', $keys)) {
            $attributes['identificationNumber'] = $taxation->getIdentificationNumber();
        }
        if (in_array('outstandingTaxBalance', $keys)) {
            $attributes['outstandingTaxBalance'] = $taxation->getOutstandingTaxBalance();
        }
        if (in_array('totalTaxAmount', $keys)) {
            $attributes['totalTaxAmount'] = $taxation->getTotalTaxAmount();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($taxation->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($taxation->getStaff()->getId())
            );
        }

        return $expression;
    }
}

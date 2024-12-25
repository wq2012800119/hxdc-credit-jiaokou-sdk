<?php
namespace Sdk\CreditModule\Financing\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\Financing\Model\Financing;
use Sdk\CreditModule\Financing\Model\NullFinancing;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class FinancingRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $financing = null)
    {
        if (empty($expression)) {
            return NullFinancing::getInstance();
        }

        if ($financing == null) {
            $financing = new Financing();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $financing->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $financing->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $financing->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['financedAt'])) {
            $financing->setFinancedAt($attributes['financedAt']);
        }
        if (isset($attributes['stage'])) {
            $financing->setStage($attributes['stage']);
        }
        if (isset($attributes['amount'])) {
            $financing->setAmount($attributes['amount']);
        }
        if (isset($attributes['status'])) {
            $financing->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $financing->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $financing->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $financing->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $financing->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $financing->setStaff($staff);
        }
        
        return $financing;
    }

    public function objectToArray($financing, array $keys = array())
    {
        if (!$financing instanceof Financing) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'financedAt',
                'stage',
                'amount',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'financing'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $financing->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $financing->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $financing->getUnifiedIdentifier();
        }
        if (in_array('financedAt', $keys)) {
            $attributes['financedAt'] = $financing->getFinancedAt();
        }
        if (in_array('stage', $keys)) {
            $attributes['stage'] = $financing->getStage();
        }
        if (in_array('amount', $keys)) {
            $attributes['amount'] = $financing->getAmount();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($financing->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($financing->getStaff()->getId())
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\CreditModule\Collateral\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\Collateral\Model\Collateral;
use Sdk\CreditModule\Collateral\Model\NullCollateral;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CollateralRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $collateral = null)
    {
        if (empty($expression)) {
            return NullCollateral::getInstance();
        }

        if ($collateral == null) {
            $collateral = new Collateral();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $collateral->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $collateral->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $collateral->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['registrationNumber'])) {
            $collateral->setRegistrationNumber($attributes['registrationNumber']);
        }
        if (isset($attributes['registrationDate'])) {
            $collateral->setRegistrationDate($attributes['registrationDate']);
        }
        if (isset($attributes['registrationAgency'])) {
            $collateral->setRegistrationAgency($attributes['registrationAgency']);
        }
        if (isset($attributes['securedBondAmount'])) {
            $collateral->setSecuredBondAmount($attributes['securedBondAmount']);
        }
        if (isset($attributes['mortgageStatus'])) {
            $collateral->setMortgageStatus($attributes['mortgageStatus']);
        }
        if (isset($attributes['status'])) {
            $collateral->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $collateral->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $collateral->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $collateral->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $collateral->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $collateral->setStaff($staff);
        }
        
        return $collateral;
    }

    public function objectToArray($collateral, array $keys = array())
    {
        if (!$collateral instanceof Collateral) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'registrationNumber',
                'registrationDate',
                'registrationAgency',
                'securedBondAmount',
                'mortgageStatus',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'collaterals'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $collateral->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $collateral->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $collateral->getUnifiedIdentifier();
        }
        if (in_array('registrationNumber', $keys)) {
            $attributes['registrationNumber'] = $collateral->getRegistrationNumber();
        }
        if (in_array('registrationDate', $keys)) {
            $attributes['registrationDate'] = $collateral->getRegistrationDate();
        }
        if (in_array('registrationAgency', $keys)) {
            $attributes['registrationAgency'] = $collateral->getRegistrationAgency();
        }
        if (in_array('securedBondAmount', $keys)) {
            $attributes['securedBondAmount'] = $collateral->getSecuredBondAmount();
        }
        if (in_array('mortgageStatus', $keys)) {
            $attributes['mortgageStatus'] = $collateral->getMortgageStatus();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($collateral->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($collateral->getStaff()->getId())
            );
        }

        return $expression;
    }
}

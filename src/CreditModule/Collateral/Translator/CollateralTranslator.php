<?php
namespace Sdk\CreditModule\Collateral\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Collateral\Model\Collateral;
use Sdk\CreditModule\Collateral\Model\NullCollateral;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class CollateralTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullCollateral::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($collateral->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $collateral->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $collateral->getUnifiedIdentifier();
        }
        if (in_array('registrationNumber', $keys)) {
            $expression['registrationNumber'] = $collateral->getRegistrationNumber();
        }
        if (in_array('registrationDate', $keys)) {
            $expression['registrationDate'] = $collateral->getRegistrationDate();
            $expression['registrationDateFormatConvert'] = date('Y-m-d', $collateral->getRegistrationDate());
        }
        if (in_array('registrationAgency', $keys)) {
            $expression['registrationAgency'] = $collateral->getRegistrationAgency();
        }
        if (in_array('securedBondAmount', $keys)) {
            $expression['securedBondAmount'] = $collateral->getSecuredBondAmount();
        }
        if (in_array('mortgageStatus', $keys)) {
            $expression['mortgageStatus'] = $collateral->getMortgageStatus();
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $collateral->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($collateral, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $collateral->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $collateral->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $collateral->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $collateral->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Collateral $collateral, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $collateral->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $collateral->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

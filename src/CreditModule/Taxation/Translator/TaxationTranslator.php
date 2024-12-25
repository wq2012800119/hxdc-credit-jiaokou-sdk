<?php
namespace Sdk\CreditModule\Taxation\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Taxation\Model\Taxation;
use Sdk\CreditModule\Taxation\Model\NullTaxation;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class TaxationTranslator implements ITranslator
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
        return NullTaxation::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($taxation->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $taxation->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $taxation->getUnifiedIdentifier();
        }
        if (in_array('identificationNumber', $keys)) {
            $expression['identificationNumber'] = $taxation->getIdentificationNumber();
        }
        if (in_array('outstandingTaxBalance', $keys)) {
            $expression['outstandingTaxBalance'] = $taxation->getOutstandingTaxBalance();
        }
        if (in_array('totalTaxAmount', $keys)) {
            $expression['totalTaxAmount'] = $taxation->getTotalTaxAmount();
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $taxation->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($taxation, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $taxation->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $taxation->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $taxation->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $taxation->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Taxation $taxation, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $taxation->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $taxation->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

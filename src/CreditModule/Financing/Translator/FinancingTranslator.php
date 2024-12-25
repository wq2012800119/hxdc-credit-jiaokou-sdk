<?php
namespace Sdk\CreditModule\Financing\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\Financing\Model\Financing;
use Sdk\CreditModule\Financing\Model\NullFinancing;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class FinancingTranslator implements ITranslator
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
        return NullFinancing::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($financing->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $financing->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $financing->getUnifiedIdentifier();
        }
        if (in_array('financedAt', $keys)) {
            $expression['financedAt'] = $financing->getFinancedAt();
            $expression['financedAtFormatConvert'] = date('Y-m-d', $financing->getFinancedAt());
        }
        if (in_array('stage', $keys)) {
            $expression['stage'] = $financing->getStage();
        }
        if (in_array('amount', $keys)) {
            $expression['amount'] = $financing->getAmount();
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $financing->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($financing, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $financing->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $financing->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $financing->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $financing->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Financing $financing, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $financing->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $financing->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Application\Commitment\Model\Promise;
use Sdk\Application\Commitment\Model\NullPromise;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class PromiseTranslator implements ITranslator
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
        return NullPromise::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($promise, array $keys = array())
    {
        if (!$promise instanceof Promise) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'fulfillmentStatus',
                'unperformedCommitmentContent',
                'liabilityBreachCommitmentContent',
                'fulfillmentStatusDate',
                'acceptanceConfirmUnit',
                'acceptanceConfirmUnitIdentify',
                'staff' => ['id', 'subjectName'],
                'organization' => ['id', 'name'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($promise->getId());
        }
        if (in_array('unperformedCommitmentContent', $keys)) {
            $expression['unperformedCommitmentContent'] = $promise->getUnperformedCommitmentContent();
        }
        if (in_array('liabilityBreachCommitmentContent', $keys)) {
            $expression['liabilityBreachCommitmentContent'] = $promise->getLiabilityBreachCommitmentContent();
        }
        if (in_array('fulfillmentStatusDate', $keys)) {
            $expression['fulfillmentStatusDate'] = $promise->getFulfillmentStatusDate();
            $expression['fulfillmentStatusDateFormatConvert'] = !empty($promise->getFulfillmentStatusDate()) ?
                date('Y-m-d', $promise->getFulfillmentStatusDate()) :
                '';
        }
        if (in_array('acceptanceConfirmUnit', $keys)) {
            $expression['acceptanceConfirmUnit'] = $promise->getAcceptanceConfirmUnit();
        }
        if (in_array('acceptanceConfirmUnitIdentify', $keys)) {
            $expression['acceptanceConfirmUnitIdentify'] = $promise->getAcceptanceConfirmUnitIdentify();
        }
        $expression = $this->typeObjectToArray($promise, $keys, $expression);
        $expression = $this->relationObjectToArray($promise, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $promise->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $promise->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $promise->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $promise->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Promise $promise, array $keys, array $expression) : array
    {
        if (in_array('fulfillmentStatus', $keys)) {
            $expression['fulfillmentStatus'] = $this->typeFormatConversion(
                $promise->getFulfillmentStatus(),
                Promise::FULFILLMENT_STATUS_CN
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $promise->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $promise->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }

        return $expression;
    }

    protected function relationObjectToArray(Promise $promise, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $promise->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $promise->getOrganization(),
                $keys['organization']
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Application\Commitment\Model\Commitment;
use Sdk\Application\Commitment\Model\NullCommitment;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class CommitmentTranslator implements ITranslator
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

    protected function getPromiseTranslator() : PromiseTranslator
    {
        return new PromiseTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullCommitment::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function objectToArray($commitment, array $keys = array())
    {
        if (!$commitment instanceof Commitment) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'code',
                'subjectName',
                'subjectCategory',
                'identify',
                'commitmentTypeId',
                'commitmentTypeOther',
                'reason',
                'content',
                'liabilityBreachCommitment',
                'commitmentDate',
                'commitmentValidity',
                'acceptanceUnit',
                'acceptanceUnitIdentify',
                'publicationType',
                'remarks',
                'superviseStatus',
                'pastDueStatus',
                'staff' => ['id', 'subjectName'],
                'organization' => ['id', 'name'],
                'promise' => [
                    'id',
                    'fulfillmentStatus',
                    'unperformedCommitmentContent',
                    'liabilityBreachCommitmentContent',
                    'fulfillmentStatusDate',
                    'acceptanceConfirmUnit',
                    'acceptanceConfirmUnitIdentify'
                ],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($commitment->getId());
        }
        if (in_array('code', $keys)) {
            $expression['code'] = $commitment->getCode();
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $commitment->getSubjectName();
        }
        if (in_array('identify', $keys)) {
            $expression['identify'] = $commitment->getIdentify();
        }
        if (in_array('commitmentTypeOther', $keys)) {
            $expression['commitmentTypeOther'] = $commitment->getCommitmentTypeOther();
        }
        if (in_array('reason', $keys)) {
            $expression['reason'] = $commitment->getReason();
        }
        if (in_array('content', $keys)) {
            $expression['content'] = $commitment->getContent();
        }
        if (in_array('liabilityBreachCommitment', $keys)) {
            $expression['liabilityBreachCommitment'] = $commitment->getLiabilityBreachCommitment();
        }
        if (in_array('commitmentDate', $keys)) {
            $expression['commitmentDate'] = $commitment->getCommitmentDate();
            $expression['commitmentDateFormatConvert'] = date('Y-m-d', $commitment->getCommitmentDate());
        }
        if (in_array('commitmentValidity', $keys)) {
            $expression['commitmentValidity'] = $commitment->getCommitmentValidity();
            $expression['commitmentValidityFormatConvert'] = date('Y-m-d', $commitment->getCommitmentValidity());
        }
        if (in_array('acceptanceUnit', $keys)) {
            $expression['acceptanceUnit'] = $commitment->getAcceptanceUnit();
        }
        if (in_array('acceptanceUnitIdentify', $keys)) {
            $expression['acceptanceUnitIdentify'] = $commitment->getAcceptanceUnitIdentify();
        }
        if (in_array('remarks', $keys)) {
            $expression['remarks'] = $commitment->getRemarks();
        }
        $expression = $this->typeObjectToArray($commitment, $keys, $expression);
        $expression = $this->relationObjectToArray($commitment, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $commitment->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $commitment->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $commitment->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $commitment->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Commitment $commitment, array $keys, array $expression) : array
    {
        if (in_array('subjectCategory', $keys)) {
            $expression['subjectCategory'] = $this->typeFormatConversion(
                $commitment->getSubjectCategory(),
                Commitment::SUBJECT_CATEGORY_CN
            );
        }
        if (in_array('commitmentTypeId', $keys)) {
            $expression['commitmentTypeId'] = $this->typeFormatConversion(
                $commitment->getCommitmentTypeId(),
                Commitment::COMMITMENT_TYPE_CN
            );
        }
        if (in_array('publicationType', $keys)) {
            $expression['publicationType'] = $this->typeFormatConversion(
                $commitment->getPublicationType(),
                Commitment::PUBLICATION_TYPE_CN
            );
        }
        if (in_array('superviseStatus', $keys)) {
            $expression['superviseStatus'] = $this->typeFormatConversion(
                $commitment->getSuperviseStatus(),
                Commitment::SUPERVISE_STATUS_CN
            );
        }
        if (in_array('pastDueStatus', $keys)) {
            $expression['pastDueStatus'] = $this->typeFormatConversion(
                $commitment->getPastDueStatus(),
                Commitment::PAST_DUE_STATUS_CN
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $commitment->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $commitment->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }

        return $expression;
    }

    protected function relationObjectToArray(Commitment $commitment, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $commitment->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $commitment->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['promise'])) {
            $expression['promise'] = $this->getPromiseTranslator()->objectToArray(
                $commitment->getPromise(),
                $keys['promise']
            );
        }

        return $expression;
    }
}

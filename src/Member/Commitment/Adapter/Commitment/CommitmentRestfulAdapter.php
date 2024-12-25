<?php
namespace Sdk\Member\Commitment\Adapter\Commitment;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Member\Commitment\Model\Commitment;
use Sdk\Member\Commitment\Model\NullCommitment;
use Sdk\Member\Commitment\Translator\CommitmentRestfulTranslator;

class CommitmentRestfulAdapter extends CommonRestfulAdapter implements ICommitmentAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'code' => COMMITMENT_CODE_FORMAT_INCORRECT,
            'subjectName' => COMMITMENT_SUBJECT_NAME_FORMAT_INCORRECT,
            'subjectCategory' => COMMITMENT_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'identify' => COMMITMENT_IDENTIFY_FORMAT_INCORRECT,
            'commitmentTypeId' => COMMITMENT_TYPE_ID_FORMAT_INCORRECT,
            'commitmentTypeOther' => COMMITMENT_TYPE_OTHER_FORMAT_INCORRECT ,
            'reason' => COMMITMENT_REASON_FORMAT_INCORRECT,
            'content' => COMMITMENT_CONTENT_FORMAT_INCORRECT ,
            'liabilityBreachCommitment' => COMMITMENT_LIABILITY_BREACH_COMMITMENT_FORMAT_INCORRECT,
            'commitmentDate' => COMMITMENT_DATE_FORMAT_INCORRECT,
            'commitmentValidity' => COMMITMENT_VALIDITY_FORMAT_INCORRECT,
            'acceptanceUnit' => COMMITMENT_ACCEPTANCE_UNIT_FORMAT_INCORRECT,
            'acceptanceUnitIdentify' => COMMITMENT_ACCEPTANCE_UNIT_IDENTIFY_FORMAT_INCORRECT,
            'publicationType' => COMMITMENT_PUBLICATION_TYPE_FORMAT_INCORRECT,
            'remarks' => COMMITMENT_REMARKS_FORMAT_INCORRECT,
            'fulfillmentStatus' => COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT ,
            'unperformedCommitmentContent' => COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT,
            'liabilityBreachCommitmentContent' => COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT,
            'fulfillmentStatusDate' => COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT,
            'acceptanceConfirmUnit' => COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT,
            'acceptanceConfirmUnitIdentify' => COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT,
            'superviseStatus' => COMMITMENT_SUPERVISE_STATUS_FORMAT_INCORRECT,
            'attachments' => SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT,
            'certificateType' => SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT,
            'certificateId' => SELF_DECLARATION_CERTIFICATE_ID_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'memberCommitment' => PARAMETER_FORMAT_ERROR,
            'rejectReason' => REASON_FORMAT_INCORRECT,
            'organization' => ORGANIZATION_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'member' => MEMBER_NOT_EXISTS,
            'organization' => ORGANIZATION_NOT_EXISTS,
            'certificate' => SELF_DECLARATION_CERTIFICATE_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'COMMITMENT_LIST'=>[
            'fields' => [
                'commitments' => 'subjectName,identify,commitmentTypeId,CommitmentTypeOther,subjectCategory,examineStatus,promise,updateTime'//phpcs:ignore
            ],
            'include' => 'member,staff,organization,promise'
        ],
        'COMMITMENT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'member,staff,organization,promise'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CommitmentRestfulTranslator(),
            'members/commitments',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCommitment::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    private function insertAndUpdateCommonTranslatorKeys() : array
    {
        return array(
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
            'fulfillmentStatus',
            'unperformedCommitmentContent',
            'liabilityBreachCommitmentContent',
            'fulfillmentStatusDate',
            'acceptanceConfirmUnit',
            'acceptanceConfirmUnitIdentify',
            'certificateType',
            'certificateId',
            'attachments',
            'organization'
        );
    }

    protected function insertTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }

    public function approve(IExamineAble $commitment) : bool
    {
        $data = $this->getTranslator()->objectToArray($commitment, array('staff'));

        $this->patch(
            $this->getResource().'/'.$commitment->getId().'/approve',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commitment);
            return true;
        }

        return false;
    }

    public function reject(IExamineAble $commitment) : bool
    {
        $data = $this->getTranslator()->objectToArray($commitment, array('rejectReason', 'staff'));

        $this->patch(
            $this->getResource().'/'.$commitment->getId().'/reject',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commitment);
            return true;
        }

        return false;
    }

    public function revoke(Commitment $commitment) : bool
    {
        $this->patch(
            $this->getResource().'/'.$commitment->getId().'/revoke'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($commitment);
            return true;
        }

        return false;
    }
}

<?php
namespace Sdk\Member\Commitment\Translator;

use Marmot\Interfaces\INull;

use Sdk\Member\Commitment\Model\Commitment;
use Sdk\Member\Commitment\Model\NullCommitment;

use Sdk\Application\Commitment\Translator\CommitmentTranslator as ApplicationCommitmentTranslator;

use Sdk\User\Member\Translator\MemberTranslator;

class CommitmentTranslator extends ApplicationCommitmentTranslator
{
    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullCommitment::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
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
                'updateTime',
                'rejectReason',
                'certificateType',
                'certificateId',
                'attachments',
                'member' => ['id', 'subjectName']
            );
        }

        $expression = parent::objectToArray($commitment, $keys);

        if (in_array('attachments', $keys)) {
            $expression['attachments'] = $commitment->getAttachments();
        }
        if (in_array('certificateId', $keys)) {
            $expression['certificateId'] = $commitment->getCertificateId();
        }
        if (in_array('rejectReason', $keys)) {
            $expression['rejectReason'] = $commitment->getRejectReason();
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $commitment->getExamineStatus(),
                Commitment::COMMITMENT_EXAMINE_STATUS_TYPE,
                Commitment::COMMITMENT_EXAMINE_STATUS_CN
            );
        }
        if (in_array('certificateType', $keys)) {
            $expression['certificateType'] = $this->typeFormatConversion(
                $commitment->getCertificateType(),
                Commitment::CERTIFICATE_TYPE_CN
            );
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $commitment->getMember(),
                $keys['member']
            );
        }

        return $expression;
    }
}

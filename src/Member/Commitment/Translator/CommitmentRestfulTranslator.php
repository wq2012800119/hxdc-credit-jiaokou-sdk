<?php
namespace Sdk\Member\Commitment\Translator;

use Sdk\Member\Commitment\Model\Commitment;
use Sdk\Member\Commitment\Model\NullCommitment;
use Sdk\Application\Commitment\Translator\CommitmentRestfulTranslator as ApplicationCommitmentRestfulTranslator;

use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CommitmentRestfulTranslator extends ApplicationCommitmentRestfulTranslator
{

    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    public function arrayToObject(array $expression, $commitment = null)
    {
        if (empty($expression)) {
            return NullCommitment::getInstance();
        }

        if ($commitment == null) {
            $commitment = new Commitment();
        }
       
        $commitment = parent::arrayToObject($expression, $commitment);

        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($attributes['fulfillmentStatus'])) {
            $commitment->getPromise()->setFulfillmentStatus($attributes['fulfillmentStatus']);
        }
        if (isset($attributes['unperformedCommitmentContent'])) {
            $commitment->getPromise()->setUnperformedCommitmentContent($attributes['unperformedCommitmentContent']);
        }
        if (isset($attributes['liabilityBreachCommitmentContent'])) {
            $commitment->getPromise()->setLiabilityBreachCommitmentContent(
                $attributes['liabilityBreachCommitmentContent']
            );
        }
        if (isset($attributes['fulfillmentStatusDate'])) {
            $commitment->getPromise()->setFulfillmentStatusDate($attributes['fulfillmentStatusDate']);
        }
        if (isset($attributes['acceptanceConfirmUnit'])) {
            $commitment->getPromise()->setAcceptanceConfirmUnit($attributes['acceptanceConfirmUnit']);
        }
        if (isset($attributes['acceptanceConfirmUnitIdentify'])) {
            $commitment->getPromise()->setAcceptanceConfirmUnitIdentify(
                $attributes['acceptanceConfirmUnitIdentify']
            );
        }
        if (isset($attributes['certificateType'])) {
            $commitment->setCertificateType($attributes['certificateType']);
        }
        if (isset($attributes['certificateId'])) {
            $commitment->setCertificateId($attributes['certificateId']);
        }
        if (isset($attributes['attachments'])) {
            $commitment->setAttachments($attributes['attachments']);
        }
        if (isset($attributes['rejectReason'])) {
            $commitment->setRejectReason($attributes['rejectReason']);
        }
        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $commitment->setMember($member);
        }
        
        return $commitment;
    }

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
                'fulfillmentStatus',
                'unperformedCommitmentContent',
                'liabilityBreachCommitmentContent',
                'fulfillmentStatusDate',
                'acceptanceConfirmUnit',
                'acceptanceConfirmUnitIdentify',
                'staff',
                'certificateType',
                'certificateId',
                'attachments',
                'organization',
                'rejectReason',
                'member'
            );
        }

        $parentExpression = parent::objectToArray($commitment, $keys);
        $parentAttributes = isset($parentExpression['data']['attributes']) ?
            $parentExpression['data']['attributes'] :
            [];
        $parentRelationships = isset($parentExpression['data']['relationships']) ?
            $parentExpression['data']['relationships'] :
            [];
        $attributes = $relationships = array();

        $expression = array(
            'data' => array(
                'type' => 'memberCommitments'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $commitment->getId();
        }
        if (in_array('certificateType', $keys)) {
            $attributes['certificateType'] = $commitment->getCertificateType();
        }
        if (in_array('certificateId', $keys)) {
            $attributes['certificateId'] = $commitment->getCertificateId();
        }
        if (in_array('attachments', $keys)) {
            $attributes['attachments'] = $commitment->getAttachments();
        }
        if (in_array('rejectReason', $keys)) {
            $attributes['rejectReason'] = $commitment->getRejectReason();
        }

        if (in_array('member', $keys)) {
            $relationships['member']['data'] = array(
                'type' => 'members',
                'id' => strval($commitment->getMember()->getId())
            );
        }
        if (in_array('organization', $keys)) {
            $relationships['organization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($commitment->getOrganization()->getId())
            );
        }

        $expression['data']['attributes'] = empty($parentAttributes) ?
                $attributes :
                array_merge($parentAttributes, $attributes);

        $expression['data']['relationships'] = empty($parentRelationships) ?
                $relationships :
                array_merge($parentRelationships, $relationships);

        if (empty($expression['data']['attributes'])) {
            unset($expression['data']['attributes']);
        }
        
        return $expression;
    }
}

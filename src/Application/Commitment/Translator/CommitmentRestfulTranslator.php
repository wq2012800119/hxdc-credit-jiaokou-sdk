<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Application\Commitment\Model\Commitment;
use Sdk\Application\Commitment\Model\NullCommitment;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CommitmentRestfulTranslator implements IRestfulTranslator
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

    protected function getPromiseRestfulTranslator() : PromiseRestfulTranslator
    {
        return new PromiseRestfulTranslator();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function arrayToObject(array $expression, $commitment = null)
    {
        if (empty($expression)) {
            return NullCommitment::getInstance();
        }

        if ($commitment == null) {
            $commitment = new Commitment();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $commitment->setId($data['id']);
        }
        if (isset($attributes['code'])) {
            $commitment->setCode($attributes['code']);
        }
        if (isset($attributes['subjectName'])) {
            $commitment->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['subjectCategory'])) {
            $commitment->setSubjectCategory($attributes['subjectCategory']);
        }
        if (isset($attributes['identify'])) {
            $commitment->setIdentify($attributes['identify']);
        }
        if (isset($attributes['commitmentTypeId'])) {
            $commitment->setCommitmentTypeId($attributes['commitmentTypeId']);
        }
        if (isset($attributes['commitmentTypeOther'])) {
            $commitment->setCommitmentTypeOther($attributes['commitmentTypeOther']);
        }
        if (isset($attributes['reason'])) {
            $commitment->setReason($attributes['reason']);
        }
        if (isset($attributes['content'])) {
            $commitment->setContent($attributes['content']);
        }
        if (isset($attributes['liabilityBreachCommitment'])) {
            $commitment->setLiabilityBreachCommitment($attributes['liabilityBreachCommitment']);
        }
        if (isset($attributes['commitmentDate'])) {
            $commitment->setCommitmentDate($attributes['commitmentDate']);
        }
        if (isset($attributes['commitmentValidity'])) {
            $commitment->setCommitmentValidity($attributes['commitmentValidity']);
        }
        if (isset($attributes['acceptanceUnit'])) {
            $commitment->setAcceptanceUnit($attributes['acceptanceUnit']);
        }
        if (isset($attributes['acceptanceUnitIdentify'])) {
            $commitment->setAcceptanceUnitIdentify($attributes['acceptanceUnitIdentify']);
        }
        if (isset($attributes['publicationType'])) {
            $commitment->setPublicationType($attributes['publicationType']);
        }
        if (isset($attributes['remarks'])) {
            $commitment->setRemarks($attributes['remarks']);
        }
        if (isset($attributes['superviseStatus'])) {
            $commitment->setSuperviseStatus($attributes['superviseStatus']);
        }
        if (isset($attributes['pastDueStatus'])) {
            $commitment->setPastDueStatus($attributes['pastDueStatus']);
        }
        if (isset($attributes['examineStatus'])) {
            $commitment->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $commitment->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $commitment->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $commitment->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $commitment->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $commitment->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $commitment->setStaff($staff);
        }
        if (isset($relationships['promise'])) {
            $promiseArray = $this->relationshipFill($relationships['promise'], $included);
            $promise = $this->getPromiseRestfulTranslator()->arrayToObject($promiseArray);
            $commitment->setPromise($promise);
        }
        
        return $commitment;
    }

    /**
     * @todo
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
                'fulfillmentStatus',
                'unperformedCommitmentContent',
                'liabilityBreachCommitmentContent',
                'fulfillmentStatusDate',
                'acceptanceConfirmUnit',
                'acceptanceConfirmUnitIdentify',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'commitments'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $commitment->getId();
        }

        $attributes = array();

        if (in_array('code', $keys)) {
            $attributes['code'] = $commitment->getCode();
        }
        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $commitment->getSubjectName();
        }
        if (in_array('subjectCategory', $keys)) {
            $attributes['subjectCategory'] = $commitment->getSubjectCategory();
        }
        if (in_array('identify', $keys)) {
            $attributes['identify'] = $commitment->getIdentify();
        }
        if (in_array('commitmentTypeId', $keys)) {
            $attributes['commitmentTypeId'] = $commitment->getCommitmentTypeId();
        }
        if (in_array('commitmentTypeOther', $keys)) {
            $attributes['commitmentTypeOther'] = $commitment->getCommitmentTypeOther();
        }
        if (in_array('reason', $keys)) {
            $attributes['reason'] = $commitment->getReason();
        }
        if (in_array('content', $keys)) {
            $attributes['content'] = $commitment->getContent();
        }
        if (in_array('liabilityBreachCommitment', $keys)) {
            $attributes['liabilityBreachCommitment'] = $commitment->getLiabilityBreachCommitment();
        }
        if (in_array('commitmentDate', $keys)) {
            $attributes['commitmentDate'] = $commitment->getCommitmentDate();
        }
        if (in_array('commitmentValidity', $keys)) {
            $attributes['commitmentValidity'] = $commitment->getCommitmentValidity();
        }
        if (in_array('acceptanceUnit', $keys)) {
            $attributes['acceptanceUnit'] = $commitment->getAcceptanceUnit();
        }
        if (in_array('acceptanceUnitIdentify', $keys)) {
            $attributes['acceptanceUnitIdentify'] = $commitment->getAcceptanceUnitIdentify();
        }
        if (in_array('publicationType', $keys)) {
            $attributes['publicationType'] = $commitment->getPublicationType();
        }
        if (in_array('remarks', $keys)) {
            $attributes['remarks'] = $commitment->getRemarks();
        }
        if (in_array('superviseStatus', $keys)) {
            $attributes['superviseStatus'] = $commitment->getSuperviseStatus();
        }
        if (in_array('fulfillmentStatus', $keys)) {
            $attributes['fulfillmentStatus'] = $commitment->getPromise()->getFulfillmentStatus();
        }
        if (in_array('unperformedCommitmentContent', $keys)) {
            $attributes['unperformedCommitmentContent'] = $commitment->getPromise()->getUnperformedCommitmentContent();
        }
        if (in_array('liabilityBreachCommitmentContent', $keys)) {
            $attributes['liabilityBreachCommitmentContent'] =
                $commitment->getPromise()->getLiabilityBreachCommitmentContent();
        }
        if (in_array('fulfillmentStatusDate', $keys)) {
            $attributes['fulfillmentStatusDate'] = $commitment->getPromise()->getFulfillmentStatusDate();
        }
        if (in_array('acceptanceConfirmUnit', $keys)) {
            $attributes['acceptanceConfirmUnit'] = $commitment->getPromise()->getAcceptanceConfirmUnit();
        }
        if (in_array('acceptanceConfirmUnitIdentify', $keys)) {
            $attributes['acceptanceConfirmUnitIdentify'] =
                $commitment->getPromise()->getAcceptanceConfirmUnitIdentify();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($commitment->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}

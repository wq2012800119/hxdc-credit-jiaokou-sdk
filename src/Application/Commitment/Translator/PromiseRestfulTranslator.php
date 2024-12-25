<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Application\Commitment\Model\Promise;
use Sdk\Application\Commitment\Model\NullPromise;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class PromiseRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $promise = null)
    {
        if (empty($expression)) {
            return NullPromise::getInstance();
        }

        if ($promise == null) {
            $promise = new Promise();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $promise->setId($data['id']);
        }
        if (isset($attributes['fulfillmentStatus'])) {
            $promise->setFulfillmentStatus($attributes['fulfillmentStatus']);
        }
        if (isset($attributes['unperformedCommitmentContent'])) {
            $promise->setUnperformedCommitmentContent($attributes['unperformedCommitmentContent']);
        }
        if (isset($attributes['liabilityBreachCommitmentContent'])) {
            $promise->setLiabilityBreachCommitmentContent($attributes['liabilityBreachCommitmentContent']);
        }
        if (isset($attributes['fulfillmentStatusDate'])) {
            $promise->setFulfillmentStatusDate($attributes['fulfillmentStatusDate']);
        }
        if (isset($attributes['acceptanceConfirmUnit'])) {
            $promise->setAcceptanceConfirmUnit($attributes['acceptanceConfirmUnit']);
        }
        if (isset($attributes['acceptanceConfirmUnitIdentify'])) {
            $promise->setAcceptanceConfirmUnitIdentify($attributes['acceptanceConfirmUnitIdentify']);
        }
        if (isset($attributes['commitmentId'])) {
            $promise->setCommitmentId($attributes['commitmentId']);
        }
        if (isset($attributes['examineStatus'])) {
            $promise->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $promise->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $promise->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $promise->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $promise->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $promise->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $promise->setStaff($staff);
        }
        
        return $promise;
    }

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
                'commitment',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'promises'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $promise->getId();
        }

        $attributes = array();

        if (in_array('fulfillmentStatus', $keys)) {
            $attributes['fulfillmentStatus'] = $promise->getFulfillmentStatus();
        }
        if (in_array('unperformedCommitmentContent', $keys)) {
            $attributes['unperformedCommitmentContent'] = $promise->getUnperformedCommitmentContent();
        }
        if (in_array('liabilityBreachCommitmentContent', $keys)) {
            $attributes['liabilityBreachCommitmentContent'] = $promise->getLiabilityBreachCommitmentContent();
        }
        if (in_array('fulfillmentStatusDate', $keys)) {
            $attributes['fulfillmentStatusDate'] = $promise->getFulfillmentStatusDate();
        }
        if (in_array('acceptanceConfirmUnit', $keys)) {
            $attributes['acceptanceConfirmUnit'] = $promise->getAcceptanceConfirmUnit();
        }
        if (in_array('acceptanceConfirmUnitIdentify', $keys)) {
            $attributes['acceptanceConfirmUnitIdentify'] = $promise->getAcceptanceConfirmUnitIdentify();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($promise->getStaff()->getId())
            );
        }
        
        if (in_array('commitment', $keys)) {
            $expression['data']['relationships']['commitment']['data'] = array(
                'type' => 'commitments',
                'id' => strval($promise->getCommitmentId())
            );
        }

        return $expression;
    }
}

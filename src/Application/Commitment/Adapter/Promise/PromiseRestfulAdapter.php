<?php
namespace Sdk\Application\Commitment\Adapter\Promise;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Application\Commitment\Model\NullPromise;
use Sdk\Application\Commitment\Translator\PromiseRestfulTranslator;

class PromiseRestfulAdapter extends CommonRestfulAdapter implements IPromiseAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'fulfillmentStatus' => COMMITMENT_FULFILLMENT_STATUS_FORMAT_INCORRECT ,
            'unperformedCommitmentContent' => COMMITMENT_UNPERFORMED_COMMITMENT_CONTENT_FORMAT_INCORRECT,
            'liabilityBreachCommitmentContent' => COMMITMENT_LIABILITY_BREACH_COMMITMENT_CONTENT_FORMAT_INCORRECT,
            'fulfillmentStatusDate' => COMMITMENT_FULFILLMENT_STATUS_DATE_FORMAT_INCORRECT,
            'acceptanceConfirmUnit' => COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_FORMAT_INCORRECT,
            'acceptanceConfirmUnitIdentify' => COMMITMENT_ACCEPTANCE_CONFIRM_UNIT_IDENTIFY_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'promise' => PROMISE_EXISTS
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'commitment' => COMMITMENT_NOT_EXISTS ,
        )
    );

    const SCENARIOS = [
        'PROMISE_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,promise'
        ],
        'PROMISE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,promise'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new PromiseRestfulTranslator(),
            'application/promises',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullPromise::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'fulfillmentStatus',
            'unperformedCommitmentContent',
            'liabilityBreachCommitmentContent',
            'fulfillmentStatusDate',
            'acceptanceConfirmUnit',
            'acceptanceConfirmUnitIdentify',
            'staff',
            'commitment'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'fulfillmentStatus',
            'unperformedCommitmentContent',
            'liabilityBreachCommitmentContent',
            'fulfillmentStatusDate',
            'acceptanceConfirmUnit',
            'acceptanceConfirmUnitIdentify'
        );
    }
}

<?php
namespace Sdk\Contract\FulfillmentInfo\Adapter\FulfillmentInfo;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Contract\FulfillmentInfo\Model\NullFulfillmentInfo;
use Sdk\Contract\FulfillmentInfo\Translator\FulfillmentInfoRestfulTranslator;

class FulfillmentInfoRestfulAdapter extends CommonRestfulAdapter implements IFulfillmentInfoAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'htzxjd' => CONTRACT_FULFILLMENT_INFO_HTZXJD_FORMAT_INCORRECT,
            'htzjsfqezf' => CONTRACT_FULFILLMENT_INFO_HTZJSFQEZF_FORMAT_INCORRECT,
            'sjlydw' => CONTRACT_SJLYDW_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100003 => array(
            'fulfillmentInfo' => FULFILLMENT_INFO_EXISTS
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'contractPerformance' =>  CONTRACT_PERFORMANCE_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'CONTRACT_FULFILLMENT_INFO_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,contractPerformance'
        ],
        'CONTRACT_FULFILLMENT_INFO_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,contractPerformance'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new FulfillmentInfoRestfulTranslator(),
            'contract/fulfillmentInfos',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullFulfillmentInfo::getInstance();
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
            'htzxjd',
            'htzjsfqezf',
            'sjlydw',
            'performance',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return [];
    }
}

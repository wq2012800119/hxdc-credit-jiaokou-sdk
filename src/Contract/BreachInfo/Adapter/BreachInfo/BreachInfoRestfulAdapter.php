<?php
namespace Sdk\Contract\BreachInfo\Adapter\BreachInfo;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Contract\BreachInfo\Model\NullBreachInfo;
use Sdk\Contract\BreachInfo\Translator\BreachInfoRestfulTranslator;

class BreachInfoRestfulAdapter extends CommonRestfulAdapter implements IBreachInfoAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'wyf' => CONTRACT_BREACH_INFO_WYF_FORMAT_INCORRECT,
            'wysy' => CONTRACT_BREACH_INFO_WYSY_FORMAT_INCORRECT,
            'wyyj' => CONTRACT_BREACH_INFO_WYYJ_FORMAT_INCORRECT,
            'wyzt' => CONTRACT_BREACH_INFO_WYZT_FORMAT_INCORRECT,
            'sjlydw' => CONTRACT_SJLYDW_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100003 => array(
            'breachInfo' =>  BREACH_INFO_EXISTS
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'contractPerformance' =>  CONTRACT_PERFORMANCE_NOT_EXISTS
        )
    );
    
    const SCENARIOS = [
        'CONTRACT_BREACH_INFO_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,contractPerformance'
        ],
        'CONTRACT_BREACH_INFO_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,contractPerformance'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new BreachInfoRestfulTranslator(),
            'contract/breachInfos',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullBreachInfo::getInstance();
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
            'wyf',
            'wysy',
            'wyyj',
            'wyzt',
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

<?php
namespace Sdk\Evaluation\Indicator\Adapter\Indicator;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Evaluation\Indicator\Model\NullIndicator;
use Sdk\Evaluation\Indicator\Translator\IndicatorRestfulTranslator;

class IndicatorRestfulAdapter extends CommonRestfulAdapter implements IIndicatorAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => EVALUATION_INDICATOR_NAME_FORMAT_INCORRECT,
            'category' => EVALUATION_INDICATOR_CATEGORY_FORMAT_INCORRECT,
            'infoCategory' => EVALUATION_INDICATOR_INFO_CATEGORY_FORMAT_INCORRECT,
            'description' => EVALUATION_INDICATOR_DESCRIPTION_FORMAT_INCORRECT,
            'source' => EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'indicator' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100070 => EVALUATION_INDICATOR_SOURCE_INFO_CATEGORY_MISMATCH,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'source' => EVALUATION_INDICATOR_SOURCE_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'INDICATOR_LIST'=>[
            'fields' => [
                'directories'=>
                    'name,infoCategory,category,sourceName,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'INDICATOR_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new IndicatorRestfulTranslator(),
            'evaluation/indicators',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullIndicator::getInstance();
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
            'name',
            'infoCategory',
            'description',
            'category',
            'sourceId',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'infoCategory',
            'description',
            'category',
            'sourceId'
        );
    }
}

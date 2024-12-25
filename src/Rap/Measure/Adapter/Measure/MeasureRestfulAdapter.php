<?php
namespace Sdk\Rap\Measure\Adapter\Measure;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Rap\Measure\Model\NullMeasure;
use Sdk\Rap\Measure\Translator\MeasureRestfulTranslator;

class MeasureRestfulAdapter extends CommonRestfulAdapter implements IMeasureAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => RAP_MEASURE_NAME_FORMAT_INCORRECT,
            'description' => RAP_MEASURE_DESCRIPTION_FORMAT_INCORRECT,
            'implementationUnits' => RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT,
            'memorandum' => RAP_MEASURE_MEMORANDUM_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'measure' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'implementationUnits' => RAP_MEASURE_IMPLEMENTATION_UNITS_NOT_EXISTS,
            'memorandum' => RAP_MEASURE_MEMORANDUM_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'MEASURE_LIST'=>[
            'fields' => [
                'directories'=>
                    'name,description,rewardType,status,updateTime',
            ],
            'include' => 'staff,organization,memorandum,implementationUnits'
        ],
        'MEASURE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,memorandum,implementationUnits'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new MeasureRestfulTranslator(),
            'rap/measures',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullMeasure::getInstance();
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
            'description',
            'implementationUnits',
            'memorandum',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'description',
            'implementationUnits'
        );
    }
}

<?php
namespace Sdk\Monitor\Opinion\Adapter\Opinion;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Monitor\Opinion\Model\NullOpinion;
use Sdk\Monitor\Opinion\Translator\OpinionRestfulTranslator;

class OpinionRestfulAdapter extends CommonRestfulAdapter implements IOpinionAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => MONITOR_OPINION_NAME_FORMAT_INCORRECT,
            'keyword' => MONITOR_OPINION_KEYWORD_FORMAT_INCORRECT,
            'category' => MONITOR_OPINION_CATEGORY_FORMAT_INCORRECT,
            'source' => MONITOR_OPINION_SOURCE_FORMAT_INCORRECT,
            'pubDate' => MONITOR_OPINION_PUB_DATE_FORMAT_INCORRECT,
            'content' => MONITOR_OPINION_CONTENT_FORMAT_INCORRECT ,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'OPINION_LIST'=>[
            'fields' => [
                'opinions'=>
                    'name,keyword,category,source,pubDate,organization,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'OPINION_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new OpinionRestfulTranslator(),
            'monitor/opinions',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullOpinion::getInstance();
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
            'name',
            'keyword',
            'category',
            'source',
            'pubDate',
            'content',
        );
    }

    protected function insertTranslatorKeys() : array
    {
        $keys = $this->insertAndUpdateCommonTranslatorKeys();
        array_push($keys, 'staff');

        return $keys;
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }
}

<?php
namespace Sdk\Resource\Data\Adapter\Data;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Resource\Data\Model\NullData;
use Sdk\Resource\Data\Translator\DataRestfulTranslator;

class DataRestfulAdapter extends CommonRestfulAdapter implements IDataAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => SUBJECT_NAME_FORMAT_INCORRECT,
            'identify' => DATA_IDENTIFY_FORMAT_INCORRECT,
            'subjectCategory' => DATA_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'infoCategory' => DATA_INFO_CATEGORY_FORMAT_INCORRECT,
            'publicationRange' => DATA_PUBLICATION_RANGE_FORMAT_INCORRECT,
            'expireDate' => DATA_EXPIRE_DATE_FORMAT_INCORRECT,
            'items' => DATA_ITEMS_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'directory' => DATA_DIRECTORY_FORMAT_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => DATA_EXISTS,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'directory' => DATA_DIRECTORY_NOT_EXISTS,
            'directorySnapshot' => DATA_DIRECTORY_SNAPSHOT_NOT_EXISTS
        ),
        100611 => DATA_ITEMS_COUNT_FORMAT_INCORRECT
    );
    
    const SCENARIOS = [
        'DATA_LIST'=>[
            'fields' => [
                'data'=>
                    'subjectName,identify,expireDate,directorySnapshot,publicationRange,organization,status,examineStatus,updateTime','subjectCategory','infoCategory','itemsIdentify',//phpcs:ignore
            ],
            'include' => 'staff,organization,directorySnapshot'
        ],
        'DATA_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,directorySnapshot'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new DataRestfulTranslator(),
            'resourceData',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullData::getInstance();
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
            'directory',
            'items',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}

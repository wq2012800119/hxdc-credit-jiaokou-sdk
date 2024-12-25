<?php
namespace Sdk\Resource\Directory\Adapter\Directory;

use Marmot\Core;
use GuzzleHttp\Client;
use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Model\NullDirectory;
use Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator;

class DirectoryRestfulAdapter extends CommonRestfulAdapter implements IDirectoryAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => DIRECTORY_NAME_FORMAT_INCORRECT,
            'identify' => DIRECTORY_IDENTIFY_FORMAT_INCORRECT,
            'subjectCategory' => DIRECTORY_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'infoCategory' => DIRECTORY_INFO_CATEGORY_FORMAT_INCORRECT,
            'sourceUnits' => DIRECTORY_SOURCE_UNITS_FORMAT_INCORRECT,
            'description' => DESCRIPTION_FORMAT_INCORRECT,
            'versionDescription' => DESCRIPTION_FORMAT_INCORRECT,
            'items' => DIRECTORY_ITEMS_FORMAT_INCORRECT,
            'items.name' => DIRECTORY_ITEMS_NAME_FORMAT_INCORRECT,
            'items.identify' => DIRECTORY_ITEMS_IDENTIFY_FORMAT_INCORRECT,
            'items.dataType' => DIRECTORY_ITEMS_DATA_TYPE_FORMAT_INCORRECT,
            'items.dataLength' => DIRECTORY_ITEMS_DATA_LENGTH_FORMAT_INCORRECT,
            'items.optionalRange' => DIRECTORY_ITEMS_OPTIONAL_RANGE_FORMAT_INCORRECT,
            'items.required' => DIRECTORY_ITEMS_REQUIRED_FORMAT_INCORRECT,
            'items.desensitization' => DIRECTORY_ITEMS_DESENSITIZATION_FORMAT_INCORRECT,
            'items.desensitizationRule' => DIRECTORY_ITEMS_DESENSITIZATION_RULE_FORMAT_INCORRECT,
            'items.publicationRange' => DIRECTORY_ITEMS_PUBLICATION_RANGE_FORMAT_INCORRECT,
            'items.remarks' => DIRECTORY_ITEMS_REMARKS_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'snapshot' => DIRECTORY_SNAPSHOT_FORMAT_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'directory' => DIRECTORY_EXISTS,
            'name' => DIRECTORY_NAME_EXISTS,
            'identify' => DIRECTORY_IDENTIFY_EXISTS,
            'items.name' => DIRECTORY_ITEMS_NAME_EXISTS,
            'items.identify' => DIRECTORY_ITEMS_IDENTIFY_EXISTS
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'sourceUnits' => DIRECTORY_SOURCE_UNITS_NOT_EXISTS,
            'snapshot' => DIRECTORY_SNAPSHOT_NOT_EXISTS
        ),
        100600 => DIRECTORY_ITEMS_COUNT_INCORRECT,
        100601 => DIRECTORY_ITEMS_SUBJECT_NAME_IDENTIFY_FORMAT_INCORRECT,
    );
    
    const SCENARIOS = [
        'DIRECTORY_LIST'=>[
            'fields' => [
                'directories'=>
                    'name,identify,subjectCategory,infoCategory,organization,status,examineStatus,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'DIRECTORY_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    const TIMEOUT = 10;

    private $baseurl;
    
    public function __construct(string $baseurl = '', array $headers = [])
    {
        $this->baseurl = $baseurl;
        parent::__construct(
            new DirectoryRestfulTranslator(),
            'resourceDirectories',
            $baseurl,
            $headers
        );
    }

    protected function getClient() : Client
    {
        $options = [
            'base_uri'=> $this->baseurl,
            'http_errors'=>false,
            'timeout'=> self::TIMEOUT
        ];
        if (Core::$container->has('guzzle.handler')) {
            $options['handler'] = Core::$container->get('guzzle.handler');
        }
        return new Client($options);
    }

    protected function getNullObject() : INull
    {
        return NullDirectory::getInstance();
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
            'identify',
            'subjectCategory',
            'infoCategory',
            'sourceUnits',
            'description',
            'versionDescription',
            'items',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'identify',
            'subjectCategory',
            'infoCategory',
            'sourceUnits',
            'description',
            'versionDescription',
            'items'
        );
    }

    public function rollback(Directory $directory) : bool
    {
        $this->patch(
            $this->getResource().'/'.$directory->getId().'/rollback/'.$directory->getSnapshotId()
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($directory);
            return true;
        }

        return false;
    }

    public function export(Directory $directory) : bool
    {
        $this->post(
            $this->getResource().'/'.$directory->getId().'/export'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($directory);
            return true;
        }

        return false;
    }
}

<?php
namespace Sdk\Resource\UploadDataTask\Adapter\UploadDataTask;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Resource\UploadDataTask\Model\NullUploadDataTask;
use Sdk\Resource\UploadDataTask\Translator\UploadDataTaskRestfulTranslator;

class UploadDataTaskRestfulAdapter extends CommonRestfulAdapter implements IUploadDataTaskAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => UPLOAD_DATA_TASK_NAME_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'directory' => UPLOAD_DATA_TASK_DIRECTORY_FORMAT_INCORRECT
        ),
        100003 => array(
            'name' => UPLOAD_DATA_TASK_NAME_EXISTS
        ),
        100004 => array(
            'name' => UPLOAD_DATA_TASK_NAME_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS,
            'directory' => UPLOAD_DATA_TASK_DIRECTORY_NOT_EXISTS
        ),
        100610 => STAFF_NOT_BELONG_TO_DIRECTORY_SOURCE_UNITS,//员工不属于目录来源单位
        100673 => UPLOAD_FILE_EXCEED_MAX_LINES_LIMIT,//上传文件超过最大行数限制
    );
    
    const SCENARIOS = [
        'UPLOAD_DATA_TASK_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,directorySnapshot,directory'
        ],
        'UPLOAD_DATA_TASK_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,directorySnapshot,directory'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new UploadDataTaskRestfulTranslator(),
            'resourceData/uploadDataTasks',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullUploadDataTask::getInstance();
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
            'directory',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}

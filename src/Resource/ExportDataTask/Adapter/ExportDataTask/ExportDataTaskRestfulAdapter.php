<?php
namespace Sdk\Resource\ExportDataTask\Adapter\ExportDataTask;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Resource\ExportDataTask\Model\NullExportDataTask;
use Sdk\Resource\ExportDataTask\Translator\ExportDataTaskRestfulTranslator;

class ExportDataTaskRestfulAdapter extends CommonRestfulAdapter implements IExportDataTaskAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'size' => EXPORT_DATA_TASK_SIZE_FORMAT_INCORRECT,
            'offset' => EXPORT_DATA_TASK_OFFSET_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'directorySnapshot' => EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_FORMAT_INCORRECT
        ),
        100004 => array(
            'name' => EXPORT_DATA_TASK_NAME_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS,
            'directorySnapshot' => EXPORT_DATA_TASK_DIRECTORY_SNAPSHOT_NOT_EXISTS
        ),
        100674 => EXPORT_DATA_SIZE_EXCEED_MAX_LINES_LIMIT,//导出数量超过最大限制
    );
    
    const SCENARIOS = [
        'EXPORT_DATA_TASK_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,directorySnapshot,directory'
        ],
        'EXPORT_DATA_TASK_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,directorySnapshot,directory'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ExportDataTaskRestfulTranslator(),
            'resourceData/exportDataTasks',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullExportDataTask::getInstance();
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
            'filter',
            'sort',
            'offset',
            'size',
            'directorySnapshot',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}

<?php
namespace Sdk\Application\ExportDataTask\Adapter\ExportDataTask;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Application\ExportDataTask\Model\ExportDataTask;
use Sdk\Application\ExportDataTask\Model\NullExportDataTask;
use Sdk\Application\ExportDataTask\Translator\ExportDataTaskRestfulTranslator;

class ExportDataTaskRestfulAdapter extends CommonRestfulAdapter implements IExportDataTaskAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'size' => EXPORT_DATA_TASK_SIZE_FORMAT_INCORRECT,
            'offset' => EXPORT_DATA_TASK_OFFSET_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100004 => array(
            'name' => EXPORT_DATA_TASK_NAME_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS
        ),
        100674 => EXPORT_DATA_SIZE_EXCEED_MAX_LINES_LIMIT,//导出数量超过最大限制
    );
    
    const EXPORT_CATEGORY_ROUTE_MAPPING = array(
        ExportDataTask::CATEGORY['COMMITMENT'] => '/application/commitments/exportTasks',
        ExportDataTask::CATEGORY['RAP_CASES'] => '/rap/cases/exportTasks',
        ExportDataTask::CATEGORY['CONTRACT_PERFORMANCE'] => '/contract/performances/exportTasks',
        ExportDataTask::CATEGORY['APPLICATION_LOG'] => '/logs/application/exportTasks',
    );

    const SCENARIOS = [
        'EXPORT_DATA_TASK_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization'
        ],
        'EXPORT_DATA_TASK_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ExportDataTaskRestfulTranslator(),
            'application/exportTasks',
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
            'staff'
        );
    }

    public function insert(IOperateAble $exportDataTask) : bool
    {
        $route = isset(self::EXPORT_CATEGORY_ROUTE_MAPPING[$exportDataTask->getCategory()]) ?
                self::EXPORT_CATEGORY_ROUTE_MAPPING[$exportDataTask->getCategory()] :
                '';

        $data = $this->getTranslator()->objectToArray($exportDataTask, $this->insertTranslatorKeys());
       
        $this->post($route, $data);
        
        if ($this->isSuccess()) {
            $this->translateToObject($exportDataTask);
            return true;
        }

        return false;
    }
    
    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}

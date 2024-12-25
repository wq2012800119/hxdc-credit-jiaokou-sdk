<?php
namespace Sdk\Application\UploadDataTask\Adapter\UploadDataTask;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;
use Sdk\Application\UploadDataTask\Model\NullUploadDataTask;
use Sdk\Application\UploadDataTask\Translator\UploadDataTaskRestfulTranslator;

class UploadDataTaskRestfulAdapter extends CommonRestfulAdapter implements IUploadDataTaskAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => UPLOAD_DATA_TASK_NAME_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100003 => array(
            'name' => UPLOAD_DATA_TASK_NAME_EXISTS
        ),
        100004 => array(
            'name' => UPLOAD_DATA_TASK_NAME_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS
        ),
        100610 => STAFF_NOT_BELONG_TO_DIRECTORY_SOURCE_UNITS,//员工不属于目录来源单位
        100673 => UPLOAD_FILE_EXCEED_MAX_LINES_LIMIT,//上传文件超过最大行数限制
    );
    
    const SCENARIOS = [
        'UPLOAD_DATA_TASK_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization'
        ],
        'UPLOAD_DATA_TASK_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    const UPLOAD_CATEGORY_ROUTE_MAPPING = array(
        UploadDataTask::CATEGORY['COMMITMENT'] => '/application/commitments/uploadTasks',
        UploadDataTask::CATEGORY['CONTRACT_PERFORMANCE'] => '/contract/performances/uploadTasks',
    );

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new UploadDataTaskRestfulTranslator(),
            'application/uploadTasks',
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
            'staff'
        );
    }

    public function insert(IOperateAble $uploadTasks) : bool
    {
        $route = isset(self::UPLOAD_CATEGORY_ROUTE_MAPPING[$uploadTasks->getCategory()]) ?
                self::UPLOAD_CATEGORY_ROUTE_MAPPING[$uploadTasks->getCategory()] :
                '';

        $data = $this->getTranslator()->objectToArray($uploadTasks, $this->insertTranslatorKeys());
       
        $this->post($route, $data);
        
        if ($this->isSuccess()) {
            $this->translateToObject($uploadTasks);
            return true;
        }

        return false;
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}

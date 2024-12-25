<?php
namespace Sdk\Resource\UploadDataTask\Adapter\Record;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Resource\UploadDataTask\Model\NullUploadDataTaskRecord;
use Sdk\Resource\UploadDataTask\Translator\RecordRestfulTranslator;

class RecordRestfulAdapter extends CommonRestfulAdapter implements IRecordAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'RECORD_LIST'=>[
            'fields' => [],
            'include' => 'task'
        ],
        'RECORD_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'task'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new RecordRestfulTranslator(),
            'resourceData/uploadDataTasks/records',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullUploadDataTaskRecord::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

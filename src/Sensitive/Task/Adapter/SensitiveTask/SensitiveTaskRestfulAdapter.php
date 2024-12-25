<?php
namespace Sdk\Sensitive\Task\Adapter\SensitiveTask;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Sensitive\Task\Model\NullSensitiveTask;
use Sdk\Sensitive\Task\Translator\SensitiveTaskRestfulTranslator;

class SensitiveTaskRestfulAdapter extends CommonRestfulAdapter implements ISensitiveTaskAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'SENSITIVE_TASK_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization'
        ],
        'SENSITIVE_TASK_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new SensitiveTaskRestfulTranslator(),
            'sensitive/filterTasks',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullSensitiveTask::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

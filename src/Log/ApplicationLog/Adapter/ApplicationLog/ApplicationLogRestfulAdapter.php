<?php
namespace Sdk\Log\ApplicationLog\Adapter\ApplicationLog;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Log\ApplicationLog\Model\NullApplicationLog;
use Sdk\Log\ApplicationLog\Translator\ApplicationLogRestfulTranslator;

class ApplicationLogRestfulAdapter extends CommonRestfulAdapter implements IApplicationLogAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'APPLICATION_LOG_LIST'=>[
            'fields' => [],
            'include' => ''
        ],
        'APPLICATION_LOG_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ApplicationLogRestfulTranslator(),
            'logs/application',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullApplicationLog::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

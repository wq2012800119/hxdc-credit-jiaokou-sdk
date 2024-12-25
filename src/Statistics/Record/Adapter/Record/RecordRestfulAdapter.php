<?php
namespace Sdk\Statistics\Record\Adapter\Record;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Statistics\Record\Model\NullRecord;
use Sdk\Statistics\Record\Translator\RecordRestfulTranslator;

class RecordRestfulAdapter extends CommonRestfulAdapter implements IRecordAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'RECORD_LIST'=>[
            'fields' => [],
            'include' => ''
        ],
        'RECORD_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new RecordRestfulTranslator(),
            'statistics/records',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullRecord::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

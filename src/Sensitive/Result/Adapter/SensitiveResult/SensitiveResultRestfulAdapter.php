<?php
namespace Sdk\Sensitive\Result\Adapter\SensitiveResult;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Sensitive\Result\Model\NullSensitiveResult;
use Sdk\Sensitive\Result\Translator\SensitiveResultRestfulTranslator;

class SensitiveResultRestfulAdapter extends CommonRestfulAdapter implements ISensitiveResultAdapter
{
    use FetchAbleRestfulAdapterTrait, MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => SENSITIVE_WORD_NAME_FORMAT_INCORRECT,
            'source' => SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT,
            'remark' => SENSITIVE_WORD_REMARK_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'sensitiveResult' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => array(
            'word' => SENSITIVE_WORD_NAME_EXISTS,
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'SENSITIVE_WORD_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization'
        ],
        'SENSITIVE_WORD_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new SensitiveResultRestfulTranslator(),
            'sensitive/results',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullSensitiveResult::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

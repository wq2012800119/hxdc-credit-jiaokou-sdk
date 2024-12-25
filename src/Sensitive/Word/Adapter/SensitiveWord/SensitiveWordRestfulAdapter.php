<?php
namespace Sdk\Sensitive\Word\Adapter\SensitiveWord;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Sensitive\Word\Model\SensitiveWord;
use Sdk\Sensitive\Word\Model\NullSensitiveWord;
use Sdk\Sensitive\Word\Translator\SensitiveWordRestfulTranslator;

class SensitiveWordRestfulAdapter extends CommonRestfulAdapter implements ISensitiveWordAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => SENSITIVE_WORD_NAME_FORMAT_INCORRECT,
            'source' => SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT,
            'remark' => SENSITIVE_WORD_REMARK_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'sensitiveWord' => PARAMETER_FORMAT_ERROR
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
            new SensitiveWordRestfulTranslator(),
            'sensitive/words',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullSensitiveWord::getInstance();
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
            'source',
            'remark',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'source',
            'remark'
        );
    }

    public function batchProcess(SensitiveWord $sensitiveWord) : bool
    {
        $data = $this->getTranslator()->objectToArray($sensitiveWord, array('staff'));

        $this->post('sensitive/words/batchProcess', $data);
        
        if ($this->isSuccess()) {
            $this->translateToObject($sensitiveWord);
            return true;
        }

        return false;
    }
}

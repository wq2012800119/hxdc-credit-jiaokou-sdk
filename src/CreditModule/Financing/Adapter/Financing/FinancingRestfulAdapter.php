<?php
namespace Sdk\CreditModule\Financing\Adapter\Financing;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\Financing\Model\NullFinancing;
use Sdk\CreditModule\Financing\Translator\FinancingRestfulTranslator;

class FinancingRestfulAdapter extends CommonRestfulAdapter implements IFinancingAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_FINANCING_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_FINANCING_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'financedAt' => CM_FINANCING_FINANCED_AT_FORMAT_INCORRECT,
            'stage' => CM_FINANCING_STAGE_FORMAT_INCORRECT,
            'amount' => CM_FINANCING_AMOUNT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'FINANCING_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'FINANCING_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new FinancingRestfulTranslator(),
            'creditModule/financing',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullFinancing::getInstance();
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
            'subjectName',
            'unifiedIdentifier',
            'financedAt',
            'stage',
            'amount',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'financedAt',
            'stage',
            'amount'
        );
    }
}

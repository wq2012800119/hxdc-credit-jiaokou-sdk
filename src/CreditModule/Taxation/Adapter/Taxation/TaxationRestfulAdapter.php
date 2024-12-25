<?php
namespace Sdk\CreditModule\Taxation\Adapter\Taxation;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\Taxation\Model\NullTaxation;
use Sdk\CreditModule\Taxation\Translator\TaxationRestfulTranslator;

class TaxationRestfulAdapter extends CommonRestfulAdapter implements ITaxationAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_TAXATION_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_TAXATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'identificationNumber' => CM_TAXATION_IDENTIFICATION_NUMBER_FORMAT_INCORRECT,
            'outstandingTaxBalance' => CM_TAXATION_OUTSTANDING_TAX_BALANCE_FORMAT_INCORRECT,
            'totalTaxAmount' => CM_TAXATION_TOTAL_TAX_AMOUNT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'TAXATION_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'TAXATION_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new TaxationRestfulTranslator(),
            'creditModule/taxation',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullTaxation::getInstance();
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
            'identificationNumber',
            'outstandingTaxBalance',
            'totalTaxAmount',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'identificationNumber',
            'outstandingTaxBalance',
            'totalTaxAmount'
        );
    }
}

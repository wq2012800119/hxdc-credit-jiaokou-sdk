<?php
namespace Sdk\CreditModule\Collateral\Adapter\Collateral;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\Collateral\Model\NullCollateral;
use Sdk\CreditModule\Collateral\Translator\CollateralRestfulTranslator;

class CollateralRestfulAdapter extends CommonRestfulAdapter implements ICollateralAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_COLLATERAL_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_COLLATERAL_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'registrationNumber' => CM_COLLATERAL_REGISTRATION_NUMBER_FORMAT_INCORRECT,
            'registrationDate' => CM_COLLATERAL_REGISTRATION_DATE_FORMAT_INCORRECT,
            'registrationAgency' => CM_COLLATERAL_REGISTRATION_AGENCY_FORMAT_INCORRECT,
            'securedBondAmount' => CM_COLLATERAL_SECURED_BOND_AMOUNT_FORMAT_INCORRECT,
            'mortgageStatus' => CM_COLLATERAL_MORTGAGE_STATUS_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'COLLATERAL_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'COLLATERAL_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CollateralRestfulTranslator(),
            'creditModule/collaterals',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCollateral::getInstance();
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
            'registrationNumber',
            'registrationDate',
            'registrationAgency',
            'securedBondAmount',
            'mortgageStatus',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'registrationNumber',
            'registrationDate',
            'registrationAgency',
            'securedBondAmount',
            'mortgageStatus'
        );
    }
}

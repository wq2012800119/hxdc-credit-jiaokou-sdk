<?php
namespace Sdk\Organization\Organization\Adapter\Organization;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Organization\Organization\Model\NullOrganization;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class OrganizationRestfulAdapter extends CommonRestfulAdapter implements IOrganizationAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'name' => NAME_FORMAT_INCORRECT,
            'shortName' => ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT,
            'jurisdictionArea' => ORGANIZATION_JURISDICTION_AREA_FORMAT_INCORRECT,
            'unifiedIdentifier' => UNIFIED_IDENTIFIER_FORMAT_INCORRECT
        ),
        100003 => array(
            'name' => ORGANIZATION_NAME_EXISTS,
            'shortName' => ORGANIZATION_SHORT_NAME_EXISTS,
            'unifiedIdentifier' => ORGANIZATION_UNIFIED_IDENTIFIER_EXISTS
        ),
        100004 => ORGANIZATION_JURISDICTION_AREA_NOT_EXISTS
    );
    
    const SCENARIOS = [
        'ORGANIZATION_LIST'=>[
            'fields' => [
                'organizations'=>'name,shortName,jurisdictionArea,updateTime',
            ],
            'include' => 'jurisdictionArea'
        ],
        'ORGANIZATION_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'jurisdictionArea'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new OrganizationRestfulTranslator(),
            'organizations',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullOrganization::getInstance();
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
            'shortName',
            'unifiedIdentifier',
            'jurisdictionArea'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'shortName',
            'unifiedIdentifier'
        );
    }
}

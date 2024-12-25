<?php
namespace Sdk\Role\Adapter\Role;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Role\Model\NullRole;
use Sdk\Role\Translator\RoleRestfulTranslator;

class RoleRestfulAdapter extends CommonRestfulAdapter implements IRoleAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'name' => NAME_FORMAT_INCORRECT,
            'purview' => ROLE_PURVIEW_FORMAT_INCORRECT
        ),
        100003 => ROLE_NAME_EXISTS
    );
    
    const SCENARIOS = [
        'ROLE_LIST'=>[
            'fields' => [
                'roles'=>'name,updateTime',
            ],
            'include' => ''
        ],
        'ROLE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new RoleRestfulTranslator(),
            'roles',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullRole::getInstance();
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
            'purview'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'purview'
        );
    }
}

<?php
namespace Sdk\Organization\Department\Adapter\Department;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Organization\Department\Model\NullDepartment;
use Sdk\Organization\Department\Translator\DepartmentRestfulTranslator;

class DepartmentRestfulAdapter extends CommonRestfulAdapter implements IDepartmentAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'name' => NAME_FORMAT_INCORRECT,
            'organization' => DEPARTMENT_ORGANIZATION_FORMAT_INCORRECT
        ),
        100003 => DEPARTMENT_NAME_EXISTS,
        100004 => DEPARTMENT_ORGANIZATION_NOT_EXISTS
    );
    
    const SCENARIOS = [
        'DEPARTMENT_LIST'=>[
            'fields' => [
                'departments'=>'name,organization,updateTime',
            ],
            'include' => 'organization'
        ],
        'DEPARTMENT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new DepartmentRestfulTranslator(),
            'departments',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullDepartment::getInstance();
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
            'organization'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name'
        );
    }
}

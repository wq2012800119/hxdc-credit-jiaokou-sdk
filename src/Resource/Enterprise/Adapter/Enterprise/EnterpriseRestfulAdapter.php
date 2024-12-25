<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use Marmot\Interfaces\INull;

use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Model\NullEnterprise;
use Sdk\Resource\Enterprise\Translator\EnterpriseRestfulTranslator;

class EnterpriseRestfulAdapter extends CommonRestfulAdapter implements IEnterpriseAdapter
{
    use FetchAbleRestfulAdapterTrait, MapErrorsTrait;

    const MAP_ERROR = array(
        100002 => RESOURCE_CAN_NOT_MODIFY
    );

    const SCENARIOS = [
        'ENTERPRISE_LIST'=>[
            'fields' => [
                'data'=> 'ztmc,ztlb,tyshxydm,fddbr,hydm,status,updateTime,jyzt,authorization'
            ],
            'include' => 'source'
        ],
        'ENTERPRISE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'source'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new EnterpriseRestfulTranslator(),
            'enterprises',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullEnterprise::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }
    
    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function authorize(Enterprise $enterprise) : bool
    {
        $this->patch(
            $this->getResource().'/'.$enterprise->getId().'/authorize'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($enterprise);
            return true;
        }

        return false;
    }

    public function unAuthorize(Enterprise $enterprise) : bool
    {
        $this->patch(
            $this->getResource().'/'.$enterprise->getId().'/unAuthorize'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($enterprise);
            return true;
        }

        return false;
    }
    
    public function fetchEnterpriseInteractionCount(Enterprise $enterprise) : Enterprise
    {
        $this->get(
            '/interaction/enterprise/'.$enterprise->getId().'/count'
        );
       
        return $this->isSuccess() ? $this->translateToObject($enterprise) : $enterprise;
    }
}

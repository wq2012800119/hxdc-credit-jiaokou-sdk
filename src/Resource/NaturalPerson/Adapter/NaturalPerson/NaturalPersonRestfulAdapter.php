<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use Marmot\Interfaces\INull;

use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Model\NullNaturalPerson;
use Sdk\Resource\NaturalPerson\Translator\NaturalPersonRestfulTranslator;

class NaturalPersonRestfulAdapter extends CommonRestfulAdapter implements INaturalPersonAdapter
{
    use FetchAbleRestfulAdapterTrait, MapErrorsTrait;

    const MAP_ERROR = array(
        100002 => RESOURCE_CAN_NOT_MODIFY
    );

    const SCENARIOS = [
        'NATURAL_PERSON_LIST'=>[
            'fields' => [
                'data'=> 'ztmc,xb,csrq,zjhm,mz,status,updateTime,authorization'
            ],
            'include' => 'source'
        ],
        'NATURAL_PERSON_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'source'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new NaturalPersonRestfulTranslator(),
            'naturalPersons',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullNaturalPerson::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }
    
    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function authorize(NaturalPerson $naturalPerson) : bool
    {
        $this->patch(
            $this->getResource().'/'.$naturalPerson->getId().'/authorize'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($naturalPerson);
            return true;
        }

        return false;
    }

    public function unAuthorize(NaturalPerson $naturalPerson) : bool
    {
        $this->patch(
            $this->getResource().'/'.$naturalPerson->getId().'/unAuthorize'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($naturalPerson);
            return true;
        }

        return false;
    }
}

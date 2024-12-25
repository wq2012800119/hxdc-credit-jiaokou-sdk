<?php
namespace Sdk\CreditReport\CommonConfig\Adapter\CommonConfig;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;
use Sdk\CreditReport\CommonConfig\Model\NullCommonConfig;
use Sdk\CreditReport\CommonConfig\Translator\CommonConfigRestfulTranslator;

class CommonConfigRestfulAdapter extends CommonRestfulAdapter implements ICommonConfigAdapter
{
    use MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'commonConfigs' => CREDIT_REPORT_COMMON_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );
    
    const SCENARIOS = [
        'COMMON_CONFIG_LIST'=>[
            'fields' => [],
            'include' => ''
        ],
        'COMMON_CONFIG_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CommonConfigRestfulTranslator(),
            'diy/commonConfigs',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCommonConfig::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function fetchNaturalPersonConfig() : CommonConfig
    {
        $this->get($this->getResource().'/creditReport/naturalPerson');
        
        return $this->isSuccess() ? $this->translateToObject() : $this->getNullObject();
    }

    public function fetchEnterpriseConfig() : CommonConfig
    {
        $this->get($this->getResource().'/creditReport/enterprise');
        
        return $this->isSuccess() ? $this->translateToObject() : $this->getNullObject();
    }

    public function updateEnterpriseConfig(CommonConfig $enterpriseConfig) : bool
    {
        $data = $this->getTranslator()->objectToArray($enterpriseConfig, array('diyContent', 'staff'));

        $this->patch(
            $this->getResource().'/creditReport/enterprise',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($enterpriseConfig);
            return true;
        }

        return false;
    }

    public function updateNaturalPersonConfig(CommonConfig $naturalPersonConfig) : bool
    {
        $data = $this->getTranslator()->objectToArray($naturalPersonConfig, array('diyContent', 'staff'));

        $this->patch(
            $this->getResource().'/creditReport/naturalPerson',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($naturalPersonConfig);
            return true;
        }

        return false;
    }
}

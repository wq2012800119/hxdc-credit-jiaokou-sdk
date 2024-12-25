<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Translator\HomePageConfigRestfulTranslator;

class HomePageConfigRestfulAdapter extends CommonRestfulAdapter implements IHomePageConfigAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'versionDescription' => DESCRIPTION_FORMAT_INCORRECT,
            'content' => HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );
    
    const SCENARIOS = [
        'HOME_PAGE_CONFIG_LIST'=>[
            'fields' => [
                'homePages'=>'versionDescription,updateTime',
            ],
            'include' => ''
        ],
        'HOME_PAGE_CONFIG_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new HomePageConfigRestfulTranslator(),
            'diy/homePages',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullHomePageConfig::getInstance();
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
            'versionDescription',
            'diyContent',
            'status',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }

    public function current() : HomePageConfig
    {
        $this->get($this->getResource().'/current');
        
        return $this->isSuccess() ? $this->translateToObject() : $this->getNullObject();
    }

    public function publish(HomePageConfig $homePageConfig) : bool
    {
        $this->patch(
            $this->getResource().'/'.$homePageConfig->getId().'/publish'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($homePageConfig);
            return true;
        }

        return false;
    }
}

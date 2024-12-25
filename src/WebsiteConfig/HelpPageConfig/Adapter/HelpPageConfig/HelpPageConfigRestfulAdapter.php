<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig;
use Sdk\WebsiteConfig\HelpPageConfig\Translator\HelpPageConfigRestfulTranslator;

class HelpPageConfigRestfulAdapter extends CommonRestfulAdapter implements IHelpPageConfigAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'title' => TITLE_FORMAT_INCORRECT,
            'style' => HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT,
            'content' => HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100003 => HELP_PAGE_CONFIG_TITLE_EXISTS,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );
    
    const SCENARIOS = [
        'HELP_PAGE_CONFIG_LIST'=>[
            'fields' => [
                'helpPages'=>'title,style,updateTime',
            ],
            'include' => ''
        ],
        'HELP_PAGE_CONFIG_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new HelpPageConfigRestfulTranslator(),
            'diy/helpPages',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullHelpPageConfig::getInstance();
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
            'title',
            'style',
            'diyContent',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'title',
            'style',
            'diyContent',
        );
    }
}

<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Utils\MockObjectGenerate;

class HomePageConfigMockAdapter implements IHomePageConfigAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateHomePageConfig($id);
    }

    public function current() : HomePageConfig
    {
        return $this->fetchObject(1);
    }
    
    public function publish(HomePageConfig $homePageConfig) : bool
    {
        unset($homePageConfig);
        return true;
    }
}

<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;

interface IHomePageConfigAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    public function publish(HomePageConfig $homePageConfig) : bool;

    public function current() : HomePageConfig;
}

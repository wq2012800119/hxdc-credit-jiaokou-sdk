<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\IHomePageConfigAdapter;
use Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\HomePageConfigMockAdapter;
use Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\HomePageConfigRestfulAdapter;

class HomePageConfigRepository extends CommonRepository implements IHomePageConfigAdapter
{
    const LIST_MODEL_UN = 'HOME_PAGE_CONFIG_LIST';
    const FETCH_ONE_MODEL_UN = 'HOME_PAGE_CONFIG_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new HomePageConfigRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new HomePageConfigMockAdapter()
        );
    }

    public function publish(HomePageConfig $homePageConfig) : bool
    {
        return $this->getAdapter()->publish($homePageConfig);
    }

    public function current() : HomePageConfig
    {
        return $this->getAdapter()->current();
    }
}

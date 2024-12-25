<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\IHelpPageConfigAdapter;
use Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\HelpPageConfigMockAdapter;
use Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\HelpPageConfigRestfulAdapter;

class HelpPageConfigRepository extends CommonRepository implements IHelpPageConfigAdapter
{
    const LIST_MODEL_UN = 'HELP_PAGE_CONFIG_LIST';
    const FETCH_ONE_MODEL_UN = 'HELP_PAGE_CONFIG_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new HelpPageConfigRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new HelpPageConfigMockAdapter()
        );
    }
}

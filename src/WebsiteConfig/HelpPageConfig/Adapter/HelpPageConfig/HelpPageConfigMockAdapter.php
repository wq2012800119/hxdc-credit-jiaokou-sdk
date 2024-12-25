<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\WebsiteConfig\HelpPageConfig\Utils\MockObjectGenerate;

class HelpPageConfigMockAdapter implements IHelpPageConfigAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateHelpPageConfig($id);
    }
}

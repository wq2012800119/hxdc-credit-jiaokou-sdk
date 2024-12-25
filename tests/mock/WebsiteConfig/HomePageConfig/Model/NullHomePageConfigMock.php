<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

class NullHomePageConfigMock extends NullHomePageConfig
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

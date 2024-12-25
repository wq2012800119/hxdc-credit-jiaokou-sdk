<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

class NullHelpPageConfigMock extends NullHelpPageConfig
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

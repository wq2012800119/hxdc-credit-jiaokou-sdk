<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Sdk\WebsiteConfig\HelpPageConfig\Repository\HelpPageConfigRepository;

class HelpPageConfigMock extends HelpPageConfig
{
    public function getRepositoryPublic() : HelpPageConfigRepository
    {
        return parent::getRepository();
    }
}

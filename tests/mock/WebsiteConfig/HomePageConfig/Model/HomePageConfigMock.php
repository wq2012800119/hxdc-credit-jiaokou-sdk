<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Sdk\WebsiteConfig\HomePageConfig\Repository\HomePageConfigRepository;

class HomePageConfigMock extends HomePageConfig
{
    public function getRepositoryPublic() : HomePageConfigRepository
    {
        return parent::getRepository();
    }
}

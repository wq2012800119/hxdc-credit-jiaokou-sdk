<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class HomePageConfigPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['WEBSITE_HOME_PAGE_CONFIG']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function publish() : bool
    {
        return $this->operation('publish');
    }
}

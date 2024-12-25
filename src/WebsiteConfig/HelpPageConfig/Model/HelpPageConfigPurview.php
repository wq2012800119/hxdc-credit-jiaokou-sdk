<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class HelpPageConfigPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['WEBSITE_HELP_PAGE_CONFIG']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
}

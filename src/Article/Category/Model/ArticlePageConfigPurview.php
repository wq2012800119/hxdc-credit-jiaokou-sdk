<?php
namespace Sdk\Article\Category\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class ArticlePageConfigPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['WEBSITE_ARTICLE_PAGE_CONFIG']);
    }

    public function diy() : bool
    {
        return $this->operation('diy');
    }
}

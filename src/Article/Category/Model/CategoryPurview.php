<?php
namespace Sdk\Article\Category\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class CategoryPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['ARTICLE_CATEGORY']);
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

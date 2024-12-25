<?php
namespace Sdk\Article\Category\Adapter\Category;

use Sdk\Article\Category\Model\Category;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

interface ICategoryAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    public function diy(Category $category) : bool;
}

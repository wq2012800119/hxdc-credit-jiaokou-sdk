<?php
namespace Sdk\Article\Category\Adapter\Category;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Utils\MockObjectGenerate;

class CategoryMockAdapter implements ICategoryAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateCategory($id);
    }

    public function diy(Category $category) : bool
    {
        unset($category);
        return true;
    }
}

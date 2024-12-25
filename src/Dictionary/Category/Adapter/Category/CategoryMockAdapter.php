<?php
namespace Sdk\Dictionary\Category\Adapter\Category;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Dictionary\Category\Utils\MockObjectGenerate;

class CategoryMockAdapter implements ICategoryAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateCategory($id);
    }
}

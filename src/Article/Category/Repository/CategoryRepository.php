<?php
namespace Sdk\Article\Category\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Adapter\Category\ICategoryAdapter;
use Sdk\Article\Category\Adapter\Category\CategoryMockAdapter;
use Sdk\Article\Category\Adapter\Category\CategoryRestfulAdapter;

class CategoryRepository extends CommonRepository implements ICategoryAdapter
{
    const LIST_MODEL_UN = 'CATEGORY_LIST';
    const FETCH_ONE_MODEL_UN = 'CATEGORY_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CategoryRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CategoryMockAdapter()
        );
    }

    public function diy(Category $category) : bool
    {
        return $this->getAdapter()->diy($category);
    }
}

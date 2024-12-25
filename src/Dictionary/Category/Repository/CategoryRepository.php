<?php
namespace Sdk\Dictionary\Category\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Dictionary\Category\Adapter\Category\ICategoryAdapter;
use Sdk\Dictionary\Category\Adapter\Category\CategoryMockAdapter;
use Sdk\Dictionary\Category\Adapter\Category\CategoryRestfulAdapter;

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
}

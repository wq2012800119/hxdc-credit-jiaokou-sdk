<?php
namespace Sdk\Dictionary\Item\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Dictionary\Item\Adapter\Item\IItemAdapter;
use Sdk\Dictionary\Item\Adapter\Item\ItemMockAdapter;
use Sdk\Dictionary\Item\Adapter\Item\ItemRestfulAdapter;

class ItemRepository extends CommonRepository implements IItemAdapter
{
    const LIST_MODEL_UN = 'ITEM_LIST';
    const FETCH_ONE_MODEL_UN = 'ITEM_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ItemRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ItemMockAdapter()
        );
    }
}

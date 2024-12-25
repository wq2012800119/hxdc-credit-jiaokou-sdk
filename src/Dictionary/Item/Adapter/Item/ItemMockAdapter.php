<?php
namespace Sdk\Dictionary\Item\Adapter\Item;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Dictionary\Item\Utils\MockObjectGenerate;

class ItemMockAdapter implements IItemAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateItem($id);
    }
}

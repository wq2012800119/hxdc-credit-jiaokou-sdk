<?php
namespace Sdk\Common\Repository;

use Sdk\Common\Adapter\MockRestfulAdapter;
use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Repository\Traits\FetchRepositoryTrait;
use Sdk\Common\Repository\Traits\OperateAbleRepositoryTrait;

class MockRepository implements IFetchAbleAdapter, IOperateAbleAdapter
{
    use FetchRepositoryTrait, OperateAbleRepositoryTrait;

    protected function getAdapter()
    {
        return new MockRestfulAdapter();
    }
}

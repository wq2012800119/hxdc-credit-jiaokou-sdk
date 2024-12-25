<?php
namespace Sdk\Common\Repository\Traits;

use Marmot\Interfaces\IAsyncAdapter;

trait FetchRepositoryTrait
{
    public function fetchOne($id)
    {
        return $this->getAdapter()->fetchOne($id);
    }

    public function fetchList(array $ids) : array
    {
        return $this->getAdapter()->fetchList($ids);
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) : array {
        return $this->getAdapter()->search($filter, $sort, $number, $size);
    }

    public function fetchOneAsync(int $id)
    {
        $adapter = $this->getAdapter();
        return $adapter instanceof IAsyncAdapter ? $adapter->fetchOneAsync($id) : '';
    }

    public function fetchListAsync(array $ids)
    {
        $adapter = $this->getAdapter();
        return $adapter instanceof IAsyncAdapter ? $adapter->fetchListAsync($ids) : array();
    }

    public function searchAsync(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) {
        $adapter = $this->getAdapter();
        return $adapter instanceof IAsyncAdapter
            ? $adapter->searchAsync($filter, $sort, $offset, $size)
            : array();
    }
}

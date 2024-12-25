<?php
namespace Sdk\Common\Repository\Traits;

use Marmot\Interfaces\IAsyncAdapter;

trait NullFetchRepositoryTrait
{
    abstract protected function repositoryNotExist() : bool;

    public function fetchOne($id)
    {
        unset($id);
        return $this->repositoryNotExist();
    }

    public function fetchList(array $ids)
    {
        unset($ids);
        return $this->repositoryNotExist();
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) {
        unset($filter);
        unset($sort);
        unset($number);
        unset($size);
        return $this->repositoryNotExist();
    }

    public function fetchOneAsync(int $id)
    {
        unset($id);
        return $this->repositoryNotExist();
    }

    public function fetchListAsync(array $ids)
    {
        unset($ids);
        return $this->repositoryNotExist();
    }

    public function searchAsync(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) {
        unset($filter);
        unset($sort);
        unset($offset);
        unset($size);
        return $this->repositoryNotExist();
    }
}

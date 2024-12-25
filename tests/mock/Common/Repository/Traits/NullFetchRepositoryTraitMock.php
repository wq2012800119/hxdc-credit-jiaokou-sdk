<?php
namespace Sdk\Common\Repository\Traits;

class NullFetchRepositoryTraitMock
{
    use NullFetchRepositoryTrait;

    public function fetchOnePublic($id)
    {
        return $this->fetchOne($id);
    }

    public function fetchListPublic(array $ids)
    {
        return $this->fetchList($ids);
    }

    public function searchPublic(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) {
        return $this->search($filter, $sort, $offset, $size);
    }

    protected function repositoryNotExist() : bool
    {
        return false;
    }

    public function fetchOneAsyncPublic(int $id)
    {
        return $this->fetchOneAsync($id);
    }

    public function fetchListAsyncPublic(array $ids)
    {
        return $this->fetchListAsync($ids);
    }

    public function searchAsyncPublic(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) {
        return $this->searchAsync($filter, $sort, $offset, $size);
    }
}

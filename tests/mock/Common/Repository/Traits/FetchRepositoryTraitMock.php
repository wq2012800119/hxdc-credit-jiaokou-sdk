<?php
namespace Sdk\Common\Repository\Traits;

class FetchRepositoryTraitMock
{
    use FetchRepositoryTrait;

    public function fetchOnePublic($id)
    {
        return $this->fetchOne($id);
    }

    public function fetchListPublic(array $ids) : array
    {
        return $this->fetchList($ids);
    }

    public function searchPublic(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) : array {
        return $this->search($filter, $sort, $offset, $size);
    }

    public function fetchOneAsyncPublic(int $id)
    {
        return $this->fetchOneAsync($id);
    }

    public function fetchListAsyncPublic(array $ids) : array
    {
        return $this->fetchListAsync($ids);
    }

    public function searchAsyncPublic(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) : array {
        return $this->searchAsync($filter, $sort, $offset, $size);
    }
}

<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\MockObject;

class FetchAbleMockAdapterTraitMock
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new MockObject($id);
    }

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

    public function fetchOneAsyncPublic($id)
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

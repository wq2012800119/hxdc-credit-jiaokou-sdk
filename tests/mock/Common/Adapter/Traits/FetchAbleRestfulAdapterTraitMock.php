<?php
namespace Sdk\Common\Adapter\Traits;

use Marmot\Interfaces\INull;

use Sdk\Common\Model\MockObject;
use Sdk\Common\Model\NullMockObject;

class FetchAbleRestfulAdapterTraitMock
{
    use FetchAbleRestfulAdapterTrait;

    public function getResource() : string
    {
        return '';
    }

    public function getNullObject() : INull
    {
        return NullMockObject::getInstance();
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
}

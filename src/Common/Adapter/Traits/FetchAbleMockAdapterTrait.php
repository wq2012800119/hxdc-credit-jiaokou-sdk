<?php
namespace Sdk\Common\Adapter\Traits;

trait FetchAbleMockAdapterTrait
{
    abstract protected function fetchObject($id);

    public function fetchOne($id)
    {
        return $this->fetchObject($id);
    }

    public function fetchList(array $ids) : array
    {
        $list = array();

        foreach ($ids as $id) {
            $list[] = $this->fetchObject($id);
        }

        return $list;
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) : array {
        unset($filter);
        unset($sort);

        $ids = [];

        for ($offset; $offset<$size; $offset++) {
            $ids[] = $offset;
        }

        $count = sizeof($ids);
        return array($this->fetchList($ids), $count);
    }

    public function fetchOneAsync(int $id)
    {
        return $this->fetchObject($id);
    }

    public function fetchListAsync(array $ids) : array
    {
        $list = array();

        foreach ($ids as $id) {
            $list[] = $this->fetchObject($id);
        }

        return $list;
    }

    public function searchAsync(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) :array {
        unset($filter);
        unset($sort);

        $ids = [];

        for ($offset; $offset<$size; $offset++) {
            $ids[] = $offset;
        }

        $count = sizeof($ids);
        return array($this->fetchListAsync($ids), $count);
    }
}

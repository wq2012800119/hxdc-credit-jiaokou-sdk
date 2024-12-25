<?php
namespace Sdk\Common\Adapter\Traits;

use Marmot\Interfaces\INull;

trait FetchAbleRestfulAdapterTrait
{
    abstract protected function getResource() : string;
    abstract protected function getNullObject() : INull;

    public function fetchOne($id)
    {
        $this->get(
            $this->getResource().'/'.$id
        );
       
        return $this->isSuccess() ? $this->translateToObject() : $this->getNullObject();
    }

    public function fetchList(array $ids) : array
    {
        $this->get(
            $this->getResource().'/'.implode(',', $ids)
        );

        return $this->isSuccess() ? $this->translateToObjects() : array(0, array());
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) : array {
        $this->get(
            $this->getResource(),
            array(
                'filter'=>$filter,
                'sort'=>implode(',', $sort),
                'size'=>$size,
                'page'=>$number
            )
        );

        return $this->isSuccess() ? $this->translateToObjects() : array(0, array());
    }

    public function fetchOneAsync(int $id)
    {
        return $this->getAsync(
            $this->getResource().'/'.$id
        );
    }

    public function fetchListAsync(array $ids)
    {
        return $this->getAsync(
            $this->getResource().'/'.implode(',', $ids)
        );
    }

    public function searchAsync(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) {
        return $this->getAsync(
            $this->getResource(),
            array(
                'filter'=>$filter,
                'sort'=>implode(',', $sort),
                'size'=>$size,
                'page'=>$number
            )
        );
    }
}

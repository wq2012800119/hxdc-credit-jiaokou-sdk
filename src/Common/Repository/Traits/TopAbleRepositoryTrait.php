<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

trait TopAbleRepositoryTrait
{
    abstract protected function getAdapter();

    public function top(ITopAble $topAbleObject) : bool
    {
        return $this->getAdapter()->top($topAbleObject);
    }

    public function cancelTop(ITopAble $topAbleObject) : bool
    {
        return $this->getAdapter()->cancelTop($topAbleObject);
    }
}

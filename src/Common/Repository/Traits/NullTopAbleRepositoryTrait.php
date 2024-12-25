<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

trait NullTopAbleRepositoryTrait
{
    abstract protected function repositoryNotExist() : bool;
    
    public function top(ITopAble $topAbleObject) : bool
    {
        unset($topAbleObject);
        return $this->repositoryNotExist();
    }

    public function cancelTop(ITopAble $topAbleObject) : bool
    {
        unset($topAbleObject);
        return $this->repositoryNotExist();
    }
}

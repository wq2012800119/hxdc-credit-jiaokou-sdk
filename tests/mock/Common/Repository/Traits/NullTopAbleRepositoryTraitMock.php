<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

class NullTopAbleRepositoryTraitMock
{
    use NullTopAbleRepositoryTrait;

    protected function repositoryNotExist() : bool
    {
        return false;
    }

    public function topPublic(ITopAble $topAbleObject)
    {
        return $this->top($topAbleObject);
    }

    public function cancelTopPublic(ITopAble $topAbleObject)
    {
        return $this->cancelTop($topAbleObject);
    }
}

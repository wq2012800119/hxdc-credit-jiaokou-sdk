<?php
namespace Sdk\Common\Repository\Traits;

use Sdk\Common\Adapter\MockRestfulAdapter;
use Sdk\Common\Model\Interfaces\ITopAble;

class TopAbleRepositoryTraitMock
{
    use TopAbleRepositoryTrait;

    protected function getAdapter()
    {
        return new MockRestfulAdapter();
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

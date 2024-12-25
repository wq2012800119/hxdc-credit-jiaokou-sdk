<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

class TopAbleRestfulAdapterTraitMock
{
    use TopAbleRestfulAdapterTrait;

    public function getResource() : string
    {
        return '';
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

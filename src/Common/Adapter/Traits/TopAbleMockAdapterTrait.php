<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

trait TopAbleMockAdapterTrait
{
    public function top(ITopAble $topAbleObject) : bool
    {
        unset($topAbleObject);
        return true;
    }

    public function cancelTop(ITopAble $topAbleObject) : bool
    {
        unset($topAbleObject);
        return true;
    }
}

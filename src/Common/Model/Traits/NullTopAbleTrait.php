<?php
namespace Sdk\Common\Model\Traits;

trait NullTopAbleTrait
{
    public function top() : bool
    {
        return $this->resourceNotExist();
    }

    public function cancelTop() : bool
    {
        return $this->resourceNotExist();
    }
}

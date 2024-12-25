<?php
namespace Sdk\Common\Model\Traits;

trait NullExamineAbleTrait
{
    public function approve() : bool
    {
        return $this->resourceNotExist();
    }

    public function reject() : bool
    {
        return $this->resourceNotExist();
    }
}

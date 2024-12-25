<?php
namespace Sdk\Common\Model\Traits;

trait NullOperateAbleTrait
{
    public function insert() : bool
    {
        return $this->resourceNotExist();
    }

    public function update() : bool
    {
        return $this->resourceNotExist();
    }

    public function enable() : bool
    {
        return $this->resourceNotExist();
    }

    public function disable() : bool
    {
        return $this->resourceNotExist();
    }
}

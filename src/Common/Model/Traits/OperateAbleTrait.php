<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

trait OperateAbleTrait
{

    abstract protected function getRepository();

    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    public function insert() : bool
    {
        return $this->getRepository()->insert($this);
    }

    public function update() : bool
    {
        return $this->getRepository()->update($this);
    }

    public function enable() : bool
    {
        if ($this->isEnableStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->enable($this);
    }

    public function disable() : bool
    {
        if (!$this->isEnableStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->disable($this);
    }

    public function isEnableStatus() : bool
    {
        return $this->getStatus() == IOperateAble::STATUS['ENABLED'];
    }
}

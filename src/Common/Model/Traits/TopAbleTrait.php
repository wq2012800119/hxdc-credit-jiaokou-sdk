<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Adapter\Interfaces\ITopAbleAdapter;

trait TopAbleTrait
{
    private $topStatus;

    abstract protected function getRepository();

    public function setTopStatus(int $topStatus): void
    {
        $this->topStatus = in_array(
            $topStatus,
            ITopAble::TOP_STATUS
        ) ? $topStatus : ITopAble::TOP_STATUS['NO_TOP'];
    }

    public function getTopStatus(): int
    {
        return $this->topStatus;
    }

    public function top() : bool
    {
        if ($this->isTopStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->top($this);
    }

    public function cancelTop() : bool
    {
        if (!$this->isTopStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->cancelTop($this);
    }

    protected function isTopStatus() : bool
    {
        return $this->getTopStatus() == ITopAble::TOP_STATUS['TOP'];
    }
}

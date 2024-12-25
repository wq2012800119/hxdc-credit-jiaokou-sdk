<?php
namespace Sdk\Common\Model\Traits;

use Marmot\Core;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

trait ExamineAbleTrait
{
    private $examineStatus;

    abstract protected function getRepository();

    public function setExamineStatus(int $examineStatus): void
    {
        $this->examineStatus = in_array(
            $examineStatus,
            IExamineAble::EXAMINE_STATUS
        ) ? $examineStatus : IExamineAble::EXAMINE_STATUS['PENDING'];
    }

    public function getExamineStatus(): int
    {
        return $this->examineStatus;
    }

    public function approve() : bool
    {
        if (!$this->isPendingExamineStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->approve($this);
    }

    public function reject() : bool
    {
        if (!$this->isPendingExamineStatus()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->reject($this);
    }

    protected function isPendingExamineStatus() : bool
    {
        return $this->getExamineStatus() == IExamineAble::EXAMINE_STATUS['PENDING'];
    }
}

<?php
namespace Sdk\Common\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

class MockObject implements IObject, IOperateAble, IExamineAble, ITopAble
{
    use Object;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->status = 0;
        $this->topStatus = 0;
        $this->examineStatus = 0;
        $this->statusTime = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->status);
        unset($this->topStatus);
        unset($this->examineStatus);
        unset($this->statusTime);
        unset($this->createTime);
        unset($this->updateTime);
    }

    public function setId($id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    public function setExamineStatus(int $examineStatus) : void
    {
        $this->examineStatus = $examineStatus;
    }

    public function getExamineStatus(): int
    {
        return $this->examineStatus;
    }

    public function setTopStatus(int $topStatus) : void
    {
        $this->topStatus = $topStatus;
    }

    public function getTopStatus(): int
    {
        return $this->topStatus;
    }

    public function insert() : bool
    {
        return true;
    }
    
    public function update() : bool
    {
        return true;
    }

    public function enable() : bool
    {
        return true;
    }
    
    public function disable() : bool
    {
        return true;
    }
    
    public function approve() : bool
    {
        return true;
    }
    
    public function reject() : bool
    {
        return true;
    }
    
    public function top() : bool
    {
        return true;
    }
    
    public function cancelTop() : bool
    {
        return true;
    }
}

<?php
namespace Sdk\Common\Model\Traits;

use Sdk\Common\Repository\MockRepository;
use Sdk\Common\Model\Interfaces\IOperateAble;

class OperateAbleTraitMock implements IOperateAble
{
    use OperateAbleTrait;

    protected function getRepository()
    {
        return new MockRepository();
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function insertPublic() : bool
    {
        return $this->insert();
    }

    public function updatePublic() : bool
    {
        return $this->update();
    }

    public function enablePublic() : bool
    {
        return $this->enable();
    }

    public function disablePublic() : bool
    {
        return $this->disable();
    }

    public function isEnableStatusPublic() : bool
    {
        return $this->isEnableStatus();
    }
}

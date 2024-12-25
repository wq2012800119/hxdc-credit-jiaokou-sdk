<?php
namespace Sdk\Common\Model\Traits;

class NullOperateAbleTraitMock
{
    use NullOperateAbleTrait;

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
}

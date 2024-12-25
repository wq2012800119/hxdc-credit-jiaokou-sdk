<?php
namespace Sdk\Common\Model\Traits;

class NullExamineAbleTraitMock
{
    use NullExamineAbleTrait;

    public function approvePublic() : bool
    {
        return $this->approve();
    }

    public function rejectPublic() : bool
    {
        return $this->reject();
    }
}

<?php
namespace Sdk\Common\Model\Traits;

class NullTopAbleTraitMock
{
    use NullTopAbleTrait;

    public function topPublic() : bool
    {
        return $this->top();
    }

    public function cancelTopPublic() : bool
    {
        return $this->cancelTop();
    }
}

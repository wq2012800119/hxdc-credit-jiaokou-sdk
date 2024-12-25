<?php
namespace Sdk\Common\Model\Traits;

use Sdk\Common\Repository\MockRepository;
use Sdk\Common\Model\Interfaces\ITopAble;

class TopAbleTraitMock implements ITopAble
{
    use TopAbleTrait;

    protected function getRepository()
    {
        return new MockRepository();
    }

    public function topPublic() : bool
    {
        return $this->top();
    }

    public function cancelTopPublic() : bool
    {
        return $this->cancelTop();
    }

    public function isTopStatusPublic() : bool
    {
        return $this->isTopStatus();
    }
}

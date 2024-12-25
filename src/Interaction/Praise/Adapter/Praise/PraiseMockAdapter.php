<?php
namespace Sdk\Interaction\Praise\Adapter\Praise;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Interaction\Praise\Model\Praise;
use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

//use Sdk\Interaction\Praise\Utils\MockObjectGenerate;

class PraiseMockAdapter implements IPraiseAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Praise($id);
       // return MockObjectGenerate::generatePraise($id);
    }

    public function accept(CommonInteraction $praise) : bool
    {
        unset($praise);
        return true;
    }

    public function forward(CommonInteraction $praise) : bool
    {
        unset($praise);
        return true;
    }

    public function revoke(CommonInteraction $praise) : bool
    {
        unset($praise);
        return true;
    }
}

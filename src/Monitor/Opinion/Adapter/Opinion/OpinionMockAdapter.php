<?php
namespace Sdk\Monitor\Opinion\Adapter\Opinion;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Monitor\Opinion\Model\Opinion;

//use Sdk\Monitor\Opinion\Utils\MockObjectGenerate;

class OpinionMockAdapter implements IOpinionAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Opinion($id);
        //return MockObjectGenerate::generateOpinion($id);
    }
}

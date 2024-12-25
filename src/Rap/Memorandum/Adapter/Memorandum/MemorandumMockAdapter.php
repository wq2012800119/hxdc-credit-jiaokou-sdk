<?php
namespace Sdk\Rap\Memorandum\Adapter\Memorandum;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Rap\Memorandum\Model\Memorandum;

//use Sdk\Rap\Memorandum\Utils\MockObjectGenerate;

class MemorandumMockAdapter implements IMemorandumAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Memorandum($id);
        //return MockObjectGenerate::generateMemorandum($id);
    }
}

<?php
namespace Sdk\Sensitive\Word\Adapter\SensitiveWord;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Sensitive\Word\Model\SensitiveWord;

//use Sdk\SensitiveWord\Utils\MockObjectGenerate;

class SensitiveWordMockAdapter implements ISensitiveWordAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new SensitiveWord($id);
        //return MockObjectGenerate::generateSensitiveWord($id);
    }

    public function batchProcess(SensitiveWord $sensitiveWord) : bool
    {
        unset($sensitiveWord);
        return true;
    }
}

<?php
namespace Sdk\Sensitive\Result\Adapter\SensitiveResult;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Sensitive\Result\Model\SensitiveResult;

//use Sdk\SensitiveResult\Utils\MockObjectGenerate;

class SensitiveResultMockAdapter implements ISensitiveResultAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new SensitiveResult($id);
        //return MockObjectGenerate::generateSensitiveResult($id);
    }
}

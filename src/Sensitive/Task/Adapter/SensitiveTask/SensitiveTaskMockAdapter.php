<?php
namespace Sdk\Sensitive\Task\Adapter\SensitiveTask;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Sensitive\Task\Model\SensitiveTask;

//use Sdk\SensitiveTask\Utils\MockObjectGenerate;

class SensitiveTaskMockAdapter implements ISensitiveTaskAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new SensitiveTask($id);
        //return MockObjectGenerate::generateSensitiveTask($id);
    }
}

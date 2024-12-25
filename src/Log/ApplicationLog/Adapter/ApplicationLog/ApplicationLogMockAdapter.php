<?php
namespace Sdk\Log\ApplicationLog\Adapter\ApplicationLog;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Log\ApplicationLog\Utils\MockObjectGenerate;

class ApplicationLogMockAdapter implements IApplicationLogAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateApplicationLog($id);
    }
}

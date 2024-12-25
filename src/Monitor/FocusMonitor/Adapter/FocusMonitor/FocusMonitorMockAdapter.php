<?php
namespace Sdk\Monitor\FocusMonitor\Adapter\FocusMonitor;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitor;

//use Sdk\Monitor\FocusMonitor\Utils\MockObjectGenerate;

class FocusMonitorMockAdapter implements IFocusMonitorAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new FocusMonitor($id);
        //return MockObjectGenerate::generateFocusMonitor($id);
    }
}

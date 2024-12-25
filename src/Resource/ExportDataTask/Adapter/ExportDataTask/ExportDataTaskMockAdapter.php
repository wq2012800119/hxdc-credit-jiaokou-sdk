<?php
namespace Sdk\Resource\ExportDataTask\Adapter\ExportDataTask;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Resource\ExportDataTask\Utils\MockObjectGenerate;

class ExportDataTaskMockAdapter implements IExportDataTaskAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateExportDataTask($id);
    }
}

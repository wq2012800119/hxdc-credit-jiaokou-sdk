<?php
namespace Sdk\Application\ExportDataTask\Adapter\ExportDataTask;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Application\ExportDataTask\Model\ExportDataTask;
use Sdk\Application\ExportDataTask\Utils\MockObjectGenerate;

class ExportDataTaskMockAdapter implements IExportDataTaskAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new ExportDataTask($id);
        //return MockObjectGenerate::generateExportDataTask($id);
    }
}

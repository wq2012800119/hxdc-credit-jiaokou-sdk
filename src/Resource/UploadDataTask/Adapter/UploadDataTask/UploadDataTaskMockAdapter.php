<?php
namespace Sdk\Resource\UploadDataTask\Adapter\UploadDataTask;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;

class UploadDataTaskMockAdapter implements IUploadDataTaskAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateUploadDataTask($id);
    }
}

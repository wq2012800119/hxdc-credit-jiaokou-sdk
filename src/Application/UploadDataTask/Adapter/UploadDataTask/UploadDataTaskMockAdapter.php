<?php
namespace Sdk\Application\UploadDataTask\Adapter\UploadDataTask;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;
use Sdk\Application\UploadDataTask\Utils\MockObjectGenerate;

class UploadDataTaskMockAdapter implements IUploadDataTaskAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new UploadDataTask($id);
        //return MockObjectGenerate::generateUploadDataTask($id);
    }
}

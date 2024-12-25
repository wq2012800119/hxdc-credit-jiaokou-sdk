<?php
namespace Sdk\Application\UploadDataTask\Adapter\Record;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;
use Sdk\Application\UploadDataTask\Utils\MockObjectGenerate;

class RecordMockAdapter implements IRecordAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new UploadDataTask($id);
        //return MockObjectGenerate::generateRecord($id);
    }
}

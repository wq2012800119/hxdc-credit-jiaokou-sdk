<?php
namespace Sdk\Resource\UploadDataTask\Adapter\Record;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;

class RecordMockAdapter implements IRecordAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateRecord($id);
    }
}

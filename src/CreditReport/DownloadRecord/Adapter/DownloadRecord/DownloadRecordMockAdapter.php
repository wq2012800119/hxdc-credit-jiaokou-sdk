<?php
namespace Sdk\CreditReport\DownloadRecord\Adapter\DownloadRecord;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditReport\DownloadRecord\Model\DownloadRecord;

//use Sdk\CreditReport\DownloadRecord\Utils\MockObjectGenerate;

class DownloadRecordMockAdapter implements IDownloadRecordAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new DownloadRecord($id);
       // return MockObjectGenerate::generateDownloadRecord($id);
    }
}

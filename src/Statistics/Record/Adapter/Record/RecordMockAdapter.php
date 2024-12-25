<?php
namespace Sdk\Statistics\Record\Adapter\Record;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Statistics\Record\Model\Record;

//use Sdk\Statistics\Record\Utils\MockObjectGenerate;

class RecordMockAdapter implements IRecordAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Record($id);
       // return MockObjectGenerate::generateRecord($id);
    }
}

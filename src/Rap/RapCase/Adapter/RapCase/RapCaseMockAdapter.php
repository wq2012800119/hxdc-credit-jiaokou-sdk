<?php
namespace Sdk\Rap\RapCase\Adapter\RapCase;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Rap\RapCase\Model\RapCase;

//use Sdk\Rap\RapCase\Utils\MockObjectGenerate;

class RapCaseMockAdapter implements IRapCaseAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new RapCase($id);
        //return MockObjectGenerate::generateRapCase($id);
    }
}

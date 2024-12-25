<?php
namespace Sdk\Application\Commitment\Adapter\Promise;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Application\Commitment\Model\Promise;
use Sdk\Application\Commitment\Utils\MockObjectGenerate;

class PromiseMockAdapter implements IPromiseAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        // return MockObjectGenerate::generatePromise($id);
        return new Promise($id);
    }
}

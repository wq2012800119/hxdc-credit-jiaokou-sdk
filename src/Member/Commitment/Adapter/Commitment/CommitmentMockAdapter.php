<?php
namespace Sdk\Member\Commitment\Adapter\Commitment;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Member\Commitment\Model\Commitment;

//use Sdk\Member\Commitment\Utils\MockObjectGenerate;

class CommitmentMockAdapter implements ICommitmentAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Commitment($id);
        //return MockObjectGenerate::generateCommitment($id);
    }

    public function revoke(Commitment $commitment) : bool
    {
        unset($commitment);
        return true;
    }
}

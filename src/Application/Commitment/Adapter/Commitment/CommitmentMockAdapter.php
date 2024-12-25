<?php
namespace Sdk\Application\Commitment\Adapter\Commitment;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Application\Commitment\Model\Commitment;
use Sdk\Application\Commitment\Utils\MockObjectGenerate;

class CommitmentMockAdapter implements ICommitmentAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        // return MockObjectGenerate::generateCommitment($id);

        return new Commitment($id);
    }

    public function superviseDoing(Commitment $commitment) : bool
    {
        unset($commitment);
        return true;
    }

    public function superviseDone(Commitment $commitment) : bool
    {
        unset($commitment);
        return true;
    }
}

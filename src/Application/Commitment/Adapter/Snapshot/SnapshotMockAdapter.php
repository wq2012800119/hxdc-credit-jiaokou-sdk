<?php
namespace Sdk\Application\Commitment\Adapter\Snapshot;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Application\Commitment\Model\CommitmentSnapshot;
use Sdk\Application\Commitment\Utils\MockObjectGenerate;

class SnapshotMockAdapter implements ISnapshotAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        // return MockObjectGenerate::generateSnapshot($id);
        return new CommitmentSnapshot($id);
    }
}

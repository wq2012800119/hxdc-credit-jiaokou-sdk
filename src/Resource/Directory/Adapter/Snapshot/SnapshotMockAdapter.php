<?php
namespace Sdk\Resource\Directory\Adapter\Snapshot;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Resource\Directory\Utils\MockObjectGenerate;

class SnapshotMockAdapter implements ISnapshotAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateSnapshot($id);
    }
}

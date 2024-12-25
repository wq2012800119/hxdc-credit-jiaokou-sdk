<?php
namespace Sdk\Application\Commitment\Adapter\PromiseSnapshot;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Application\Commitment\Model\PromiseSnapshot;
use Sdk\Application\Commitment\Utils\MockObjectGenerate;

class PromiseSnapshotMockAdapter implements IPromiseSnapshotAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        // return MockObjectGenerate::generatePromiseSnapshot($id);
        return new PromiseSnapshot($id);
    }
}

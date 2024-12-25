<?php
namespace Sdk\Resource\Directory\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Resource\Directory\Adapter\Snapshot\ISnapshotAdapter;
use Sdk\Resource\Directory\Adapter\Snapshot\SnapshotMockAdapter;
use Sdk\Resource\Directory\Adapter\Snapshot\SnapshotRestfulAdapter;

class SnapshotRepository extends CommonRepository implements ISnapshotAdapter
{
    const LIST_MODEL_UN = 'SNAPSHOT_LIST';
    const FETCH_ONE_MODEL_UN = 'SNAPSHOT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new SnapshotRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new SnapshotMockAdapter()
        );
    }
}

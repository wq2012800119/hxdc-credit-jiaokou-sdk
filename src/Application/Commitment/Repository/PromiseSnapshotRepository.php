<?php
namespace Sdk\Application\Commitment\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Application\Commitment\Adapter\PromiseSnapshot\IPromiseSnapshotAdapter;
use Sdk\Application\Commitment\Adapter\PromiseSnapshot\PromiseSnapshotMockAdapter;
use Sdk\Application\Commitment\Adapter\PromiseSnapshot\PromiseSnapshotRestfulAdapter;

class PromiseSnapshotRepository extends CommonRepository implements IPromiseSnapshotAdapter
{
    const LIST_MODEL_UN = 'SNAPSHOT_LIST';
    const FETCH_ONE_MODEL_UN = 'SNAPSHOT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new PromiseSnapshotRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new PromiseSnapshotMockAdapter()
        );
    }
}

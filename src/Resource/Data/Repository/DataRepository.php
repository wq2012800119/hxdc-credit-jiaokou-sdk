<?php
namespace Sdk\Resource\Data\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Resource\Data\Adapter\Data\IDataAdapter;
use Sdk\Resource\Data\Adapter\Data\DataMockAdapter;
use Sdk\Resource\Data\Adapter\Data\DataRestfulAdapter;

class DataRepository extends CommonRepository implements IDataAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'DATA_LIST';
    const FETCH_ONE_MODEL_UN = 'DATA_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new DataRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new DataMockAdapter()
        );
    }
}

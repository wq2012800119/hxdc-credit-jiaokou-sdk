<?php
namespace Sdk\Member\ResourceData\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Member\ResourceData\Model\ResourceData;
use Sdk\Member\ResourceData\Adapter\ResourceData\IResourceDataAdapter;
use Sdk\Member\ResourceData\Adapter\ResourceData\ResourceDataMockAdapter;
use Sdk\Member\ResourceData\Adapter\ResourceData\ResourceDataRestfulAdapter;

class ResourceDataRepository extends CommonRepository implements IResourceDataAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'RESOURCE_DATA_LIST';
    const FETCH_ONE_MODEL_UN = 'RESOURCE_DATA_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ResourceDataRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ResourceDataMockAdapter()
        );
    }

    //撤销
    public function revoke(ResourceData $resourceData) : bool
    {
        return $this->getAdapter()->revoke($resourceData);
    }
}

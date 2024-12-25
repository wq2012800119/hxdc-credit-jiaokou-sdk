<?php
namespace Sdk\Organization\Organization\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Organization\Organization\Adapter\Organization\IOrganizationAdapter;
use Sdk\Organization\Organization\Adapter\Organization\OrganizationMockAdapter;
use Sdk\Organization\Organization\Adapter\Organization\OrganizationRestfulAdapter;

class OrganizationRepository extends CommonRepository implements IOrganizationAdapter
{
    const LIST_MODEL_UN = 'ORGANIZATION_LIST';
    const FETCH_ONE_MODEL_UN = 'ORGANIZATION_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new OrganizationRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new OrganizationMockAdapter()
        );
    }
}

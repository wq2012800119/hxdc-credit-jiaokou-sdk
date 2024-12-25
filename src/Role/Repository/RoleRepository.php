<?php
namespace Sdk\Role\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Role\Adapter\Role\IRoleAdapter;
use Sdk\Role\Adapter\Role\RoleMockAdapter;
use Sdk\Role\Adapter\Role\RoleRestfulAdapter;

class RoleRepository extends CommonRepository implements IRoleAdapter
{
    const LIST_MODEL_UN = 'ROLE_LIST';
    const FETCH_ONE_MODEL_UN = 'ROLE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new RoleRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new RoleMockAdapter()
        );
    }
}

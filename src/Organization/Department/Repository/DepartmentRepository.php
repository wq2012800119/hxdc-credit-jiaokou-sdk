<?php
namespace Sdk\Organization\Department\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Organization\Department\Adapter\Department\IDepartmentAdapter;
use Sdk\Organization\Department\Adapter\Department\DepartmentMockAdapter;
use Sdk\Organization\Department\Adapter\Department\DepartmentRestfulAdapter;

class DepartmentRepository extends CommonRepository implements IDepartmentAdapter
{
    const LIST_MODEL_UN = 'DEPARTMENT_LIST';
    const FETCH_ONE_MODEL_UN = 'DEPARTMENT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new DepartmentRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new DepartmentMockAdapter()
        );
    }
}

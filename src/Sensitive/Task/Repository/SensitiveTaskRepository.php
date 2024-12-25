<?php
namespace Sdk\Sensitive\Task\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Sensitive\Task\Adapter\SensitiveTask\ISensitiveTaskAdapter;
use Sdk\Sensitive\Task\Adapter\SensitiveTask\SensitiveTaskMockAdapter;
use Sdk\Sensitive\Task\Adapter\SensitiveTask\SensitiveTaskRestfulAdapter;

class SensitiveTaskRepository extends CommonRepository implements ISensitiveTaskAdapter
{
    const LIST_MODEL_UN = 'SENSITIVE_TASK_LIST';
    const FETCH_ONE_MODEL_UN = 'SENSITIVE_TASK_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new SensitiveTaskRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new SensitiveTaskMockAdapter()
        );
    }
}

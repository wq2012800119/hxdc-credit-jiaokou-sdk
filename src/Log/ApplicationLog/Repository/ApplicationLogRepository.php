<?php
namespace Sdk\Log\ApplicationLog\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Log\ApplicationLog\Adapter\ApplicationLog\IApplicationLogAdapter;
use Sdk\Log\ApplicationLog\Adapter\ApplicationLog\ApplicationLogMockAdapter;
use Sdk\Log\ApplicationLog\Adapter\ApplicationLog\ApplicationLogRestfulAdapter;

class ApplicationLogRepository extends CommonRepository implements IApplicationLogAdapter
{
    const LIST_MODEL_UN = 'APPLICATION_LOG_LIST';
    const FETCH_ONE_MODEL_UN = 'APPLICATION_LOG_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ApplicationLogRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ApplicationLogMockAdapter()
        );
    }
}

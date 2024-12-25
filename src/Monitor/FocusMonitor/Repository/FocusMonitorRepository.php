<?php
namespace Sdk\Monitor\FocusMonitor\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitor\IFocusMonitorAdapter;
use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitor\FocusMonitorMockAdapter;
use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitor\FocusMonitorRestfulAdapter;

class FocusMonitorRepository extends CommonRepository implements IFocusMonitorAdapter
{
    const LIST_MODEL_UN = 'FOCUS_MONITOR_LIST';
    const FETCH_ONE_MODEL_UN = 'FOCUS_MONITOR_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new FocusMonitorRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new FocusMonitorMockAdapter()
        );
    }
}

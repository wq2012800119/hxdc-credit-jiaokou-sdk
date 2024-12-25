<?php
namespace Sdk\Monitor\FocusMonitor\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport\IFocusMonitorReportAdapter;
use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport\FocusMonitorReportMockAdapter;
use Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport\FocusMonitorReportRestfulAdapter;

class FocusMonitorReportRepository extends CommonRepository implements IFocusMonitorReportAdapter
{
    const LIST_MODEL_UN = 'FOCUS_MONITOR_REPORT_LIST';
    const FETCH_ONE_MODEL_UN = 'FOCUS_MONITOR_REPORT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new FocusMonitorReportRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new FocusMonitorReportMockAdapter()
        );
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) : array {
        return $this->getAdapter()->search($filter, $sort, $number, $size);
    }
}

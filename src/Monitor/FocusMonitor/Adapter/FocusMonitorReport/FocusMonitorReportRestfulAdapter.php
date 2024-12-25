<?php
namespace Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport;

use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Monitor\FocusMonitor\Translator\FocusMonitorReportRestfulTranslator;

class FocusMonitorReportRestfulAdapter extends CommonRestfulAdapter implements IFocusMonitorReportAdapter
{
    const SCENARIOS = [
        'FOCUS_MONITOR_REPORT_LIST'=>[
            'fields' => [],
            'include' => 'focusMonitor'
        ],
        'FOCUS_MONITOR_REPORT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'focusMonitor'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new FocusMonitorReportRestfulTranslator(),
            'monitor/focusMonitors/report',
            $baseurl,
            $headers
        );
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) : array {
        $this->get(
            $this->getResource(),
            array(
                'filter'=>$filter,
                'sort'=>implode(',', $sort),
                'size'=>$size,
                'page'=>$number
            )
        );

        return $this->isSuccess() ? $this->translateToObjects() : array(0, array());
    }
}

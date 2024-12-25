<?php
namespace Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport;

interface IFocusMonitorReportAdapter
{
    //获取重点监测统计类别
    public function search(
        array $filter = array(),
        array $sort = array(),
        int $number = 0,
        int $size = 20
    ) : array;
}

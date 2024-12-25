<?php
namespace Sdk\Monitor\FocusMonitor\Adapter\FocusMonitorReport;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitorReport;

//use Sdk\Monitor\FocusMonitor\Utils\MockObjectGenerate;

class FocusMonitorReportMockAdapter implements IFocusMonitorReportAdapter
{
    public function fetchObject($id)
    {
        return new FocusMonitorReport($id);
        //return MockObjectGenerate::generateFocusMonitorReport($id);
    }

    public function search(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) : array {
        unset($filter);
        unset($sort);

        $ids = $list = [];

        for ($offset; $offset<$size; $offset++) {
            $ids[] = $offset;
        }

        $count = sizeof($ids);

        foreach ($ids as $id) {
            $list[] = $this->fetchObject($id);
        }

        return array($list, $count);
    }
}

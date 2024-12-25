<?php
namespace Sdk\Monitor\FocusMonitor\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class FocusMonitorPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['MONITOR_FOCUS_MONITOR']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
    
    public function enable() : bool
    {
        return $this->operation('enable');
    }

    public function disable() : bool
    {
        return $this->operation('disable');
    }
}

<?php
namespace Sdk\Monitor\FocusMonitor\Model;

use Marmot\Interfaces\INull;

class NullFocusMonitorReport extends FocusMonitorReport implements INull
{
    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

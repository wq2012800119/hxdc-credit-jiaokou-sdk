<?php
namespace Sdk\Sensitive\Task\Model;

use Marmot\Interfaces\INull;

class NullSensitiveTask extends SensitiveTask implements INull
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

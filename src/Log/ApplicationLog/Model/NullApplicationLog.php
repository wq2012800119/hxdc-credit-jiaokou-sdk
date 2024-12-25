<?php
namespace Sdk\Log\ApplicationLog\Model;

use Marmot\Interfaces\INull;

class NullApplicationLog extends ApplicationLog implements INull
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

<?php
namespace Sdk\Statistics\Record\Model;

use Marmot\Interfaces\INull;

class NullRecord extends Record implements INull
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

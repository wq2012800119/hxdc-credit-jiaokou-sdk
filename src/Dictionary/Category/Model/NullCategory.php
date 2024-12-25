<?php
namespace Sdk\Dictionary\Category\Model;

use Marmot\Interfaces\INull;

class NullCategory extends Category implements INull
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

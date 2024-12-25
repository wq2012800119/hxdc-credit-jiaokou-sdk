<?php
namespace Sdk\Template\Model;

use Marmot\Interfaces\INull;

class NullTemplate extends Template implements INull
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

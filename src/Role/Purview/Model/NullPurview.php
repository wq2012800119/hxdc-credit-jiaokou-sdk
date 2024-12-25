<?php
namespace Sdk\Role\Purview\Model;

use Marmot\Interfaces\INull;

class NullPurview extends Purview implements INull
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

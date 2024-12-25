<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Interfaces\INull;

class NullDirectorySnapshot extends DirectorySnapshot implements INull
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

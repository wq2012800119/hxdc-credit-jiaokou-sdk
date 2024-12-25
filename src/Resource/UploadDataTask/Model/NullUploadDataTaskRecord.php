<?php
namespace Sdk\Resource\UploadDataTask\Model;

use Marmot\Interfaces\INull;

class NullUploadDataTaskRecord extends UploadDataTaskRecord implements INull
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

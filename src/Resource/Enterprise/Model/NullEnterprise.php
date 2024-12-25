<?php
namespace Sdk\Resource\Enterprise\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

class NullEnterprise extends Enterprise implements INull
{
    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function resourceNotExist() : bool
    {
        Core::setLastError(RESOURCE_NOT_EXIST);
        return false;
    }

    public function authorize() : bool
    {
        return $this->resourceNotExist();
    }

    public function unAuthorize() : bool
    {
        return $this->resourceNotExist();
    }
}

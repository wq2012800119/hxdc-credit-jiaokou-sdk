<?php
namespace Sdk\Interaction\Praise\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

use Sdk\Common\Model\Traits\NullOperateAbleTrait;

class NullPraise extends Praise implements INull
{
    use NullOperateAbleTrait;

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

    public function accept() : bool
    {
        return $this->resourceNotExist();
    }

    public function revoke() : bool
    {
        return $this->resourceNotExist();
    }
}

<?php
namespace Sdk\CreditReport\CommonConfig\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

class NullCommonConfig extends CommonConfig implements INull
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

    public function updateEnterpriseConfig() : bool
    {
        return $this->resourceNotExist();
    }

    public function updateNaturalPersonConfig() : bool
    {
        return $this->resourceNotExist();
    }
}

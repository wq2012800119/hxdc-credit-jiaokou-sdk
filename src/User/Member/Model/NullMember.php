<?php
namespace Sdk\User\Member\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

use Sdk\Common\Model\Traits\NullOperateAbleTrait;

class NullMember extends Member implements INull
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

    public function resetPassword() : bool
    {
        return $this->resourceNotExist();
    }

    public function validateAnswer() : bool
    {
        return $this->resourceNotExist();
    }

    public function updateSecurityQuestion() : bool
    {
        return $this->resourceNotExist();
    }
    
    public function updatePassword() : bool
    {
        return $this->resourceNotExist();
    }
    
    public function login() : bool
    {
        return $this->resourceNotExist();
    }
    
    public function logout() : bool
    {
        return $this->resourceNotExist();
    }
    
    public function validatePassword() : bool
    {
        return $this->resourceNotExist();
    }
}

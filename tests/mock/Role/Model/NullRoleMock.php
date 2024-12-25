<?php
namespace Sdk\Role\Model;

class NullRoleMock extends NullRole
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

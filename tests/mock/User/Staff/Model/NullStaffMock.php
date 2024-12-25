<?php
namespace Sdk\User\Staff\Model;

class NullStaffMock extends NullStaff
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

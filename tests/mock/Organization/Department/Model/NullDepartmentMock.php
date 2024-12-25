<?php
namespace Sdk\Organization\Department\Model;

class NullDepartmentMock extends NullDepartment
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

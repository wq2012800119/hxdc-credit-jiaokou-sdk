<?php
namespace Sdk\User\Staff\Adapter\Staff;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Utils\MockObjectGenerate;

class StaffMockAdapter implements IStaffAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateStaff($id);
    }

    public function login(Staff $staff) : bool
    {
        unset($staff);
        return true;
    }

    public function resetPassword(Staff $staff) : bool
    {
        unset($staff);
        return true;
    }

    public function updatePassword(Staff $staff) : bool
    {
        unset($staff);
        return true;
    }

    public function navigation(Staff $staff) : bool
    {
        unset($staff);
        return true;
    }
}

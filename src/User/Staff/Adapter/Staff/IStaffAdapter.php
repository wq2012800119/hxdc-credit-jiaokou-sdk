<?php
namespace Sdk\User\Staff\Adapter\Staff;

use Sdk\User\Staff\Model\Staff;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

interface IStaffAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    public function login(Staff $staff) : bool;

    public function resetPassword(Staff $staff) : bool;

    public function updatePassword(Staff $staff) : bool;

    public function navigation(Staff $staff) : bool;
}

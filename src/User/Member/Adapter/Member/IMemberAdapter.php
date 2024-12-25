<?php
namespace Sdk\User\Member\Adapter\Member;

use Sdk\User\Member\Model\Member;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

interface IMemberAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    public function login(Member $member) : bool;
    
    public function validateAnswer(Member $member) : bool;

    public function updateSecurityQuestion(Member $member) : bool;

    public function resetPassword(Member $member) : bool;

    public function updatePassword(Member $member) : bool;
}

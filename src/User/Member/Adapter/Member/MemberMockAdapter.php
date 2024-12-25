<?php
namespace Sdk\User\Member\Adapter\Member;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Utils\MockObjectGenerate;

class MemberMockAdapter implements IMemberAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateMember($id);
    }

    public function login(Member $member) : bool
    {
        unset($member);
        return true;
    }

    public function validateAnswer(Member $member) : bool
    {
        unset($member);
        return true;
    }

    public function updateSecurityQuestion(Member $member) : bool
    {
        unset($member);
        return true;
    }

    public function resetPassword(Member $member) : bool
    {
        unset($member);
        return true;
    }

    public function updatePassword(Member $member) : bool
    {
        unset($member);
        return true;
    }
}

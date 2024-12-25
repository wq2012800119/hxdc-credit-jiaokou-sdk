<?php
namespace Sdk\User\Member\Model;

use Sdk\User\Member\Repository\MemberRepository;

class MemberMock extends Member
{
    public function getRepositoryPublic() : MemberRepository
    {
        return parent::getRepository();
    }

    public function getMemberCookieAuthPublic() : MemberCookieAuth
    {
        return parent::getMemberCookieAuth();
    }
}

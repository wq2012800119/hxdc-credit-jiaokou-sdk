<?php
namespace Sdk\User\Member\Model;

use Marmot\Framework\Classes\Cookie;

use Sdk\User\Member\Repository\MemberRepository;
use Sdk\User\Member\Translator\MemberTranslator;

class MemberCookieAuthMock extends MemberCookieAuth
{
    public function getCookiePublic() : Cookie
    {
        return parent::getCookie();
    }

    public function getRepositoryPublic() : MemberRepository
    {
        return parent::getRepository();
    }

    public function getTranslatorPublic() : MemberTranslator
    {
        return parent::getTranslator();
    }

    public function saveCookiePublic(Member $member) : bool
    {
        return parent::saveCookie($member);
    }

    public function saveMemberToCachePublic(Member $member) : bool
    {
        return parent::saveMemberToCache($member);
    }

    public function initMemberPublic(Member $member) : bool
    {
        return parent::initMember($member);
    }

    public function verifyCookiePublic() : bool
    {
        return parent::verifyCookie();
    }

    public function fetchMemberPublic() : Member
    {
        return parent::fetchMember();
    }

    public function clearCookiePublic() : bool
    {
        return parent::clearCookie();
    }
}

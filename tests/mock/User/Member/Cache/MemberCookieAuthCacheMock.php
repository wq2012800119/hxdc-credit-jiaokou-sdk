<?php
namespace Sdk\User\Member\Cache;

class MemberCookieAuthCacheMock extends MemberCookieAuthCache
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

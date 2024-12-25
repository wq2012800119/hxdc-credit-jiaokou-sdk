<?php
namespace Sdk\User\Member\Cache;

use Marmot\Framework\Classes\Cache;

class MemberJwtAuthCache extends Cache
{
    const KEY = 'member';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

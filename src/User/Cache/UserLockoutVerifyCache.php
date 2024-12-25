<?php
namespace Sdk\User\Cache;

use Marmot\Framework\Classes\Cache;

class UserLockoutVerifyCache extends Cache
{
    const KEY = 'user';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

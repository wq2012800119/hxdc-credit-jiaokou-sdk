<?php
namespace Sdk\User\Staff\Cache;

use Marmot\Framework\Classes\Cache;

class StaffJwtAuthCache extends Cache
{
    const KEY = 'staff';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

<?php
namespace Sdk\Common\Utils\Cache;

use Marmot\Framework\Classes\Cache;

class SlidingVerificationCache extends Cache
{
    const KEY = 'sliding_verification';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

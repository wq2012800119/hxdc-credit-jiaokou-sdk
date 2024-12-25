<?php
namespace Sdk\Common\Utils\Cache;

use Marmot\Framework\Classes\Cache;

class AesCache extends Cache
{
    const KEY = 'aes';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

<?php
namespace Sdk\Common\Utils\Cache;

use Marmot\Framework\Classes\Cache;

class CsrfCache extends Cache
{
    const KEY = 'csrf';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

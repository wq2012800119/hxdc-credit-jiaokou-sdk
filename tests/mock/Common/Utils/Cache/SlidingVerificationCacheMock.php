<?php
namespace Sdk\Common\Utils\Cache;

class SlidingVerificationCacheMock extends SlidingVerificationCache
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

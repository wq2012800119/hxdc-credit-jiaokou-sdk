<?php
namespace Sdk\Common\Utils\Cache;

class AesCacheMock extends AesCache
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

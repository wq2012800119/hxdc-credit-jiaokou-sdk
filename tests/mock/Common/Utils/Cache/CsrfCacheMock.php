<?php
namespace Sdk\Common\Utils\Cache;

class CsrfCacheMock extends CsrfCache
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

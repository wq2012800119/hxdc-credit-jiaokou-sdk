<?php
namespace Sdk\Common\Utils\SafetyVerification;

use Marmot\Interfaces\CacheLayer;

class CsrfMock extends Csrf
{
    public function getCacheLayer() : CacheLayer
    {
        return parent::getCacheLayer();
    }

    public function generateCacheTokenPublic(string $csrfToken) : bool
    {
        return $this->generateCacheToken($csrfToken);
    }
}

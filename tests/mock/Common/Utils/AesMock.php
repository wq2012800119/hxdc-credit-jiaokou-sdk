<?php
namespace Sdk\Common\Utils;

use Marmot\Interfaces\CacheLayer;

class AesMock extends Aes
{
    public function getCacheLayer() : CacheLayer
    {
        return parent::getCacheLayer();
    }

    public function generateCacheSecretKeyPublic(array $secretKey) : bool
    {
        return $this->generateCacheSecretKey($secretKey);
    }
}

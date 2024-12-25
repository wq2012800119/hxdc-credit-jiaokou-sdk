<?php
namespace Sdk\Common\Utils;

use Marmot\Core;
use Marmot\Framework\Query\DataCacheQuery;

use Sdk\Common\Utils\Cache\AesCache;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class Aes extends DataCacheQuery
{
    const AES_KEY_LENGTH = 16;
    const AES_IV_LENGTH = 16;
    const AES_CACHE_ID = 'aesSecretKey';
    const EXPIRATION_TIME = 600;

    use CharacterGeneratorTrait;

    public function __construct()
    {
        parent::__construct(new AesCache());
    }

    public function generateSecretKey() : array
    {
        $key = $this->randomChar(self::AES_KEY_LENGTH);
        $ivValue = $this->randomChar(self::AES_IV_LENGTH);
        
        $secretKey = array(
            'key' => $key,
            'iv' => $ivValue
        );
        
        $this->generateCacheSecretKey($secretKey);

        return $secretKey;
    }

    protected function generateCacheSecretKey(array $secretKey) : bool
    {
        $cacheKey = self::AES_CACHE_ID;

        return $this->save($cacheKey, $secretKey, self::EXPIRATION_TIME);
    }

    //AES加密
    public function encrypt(string $data) : string
    {
        $cacheKey = self::AES_CACHE_ID;
        $aesSecretKeyCache = $this->get($cacheKey);
        if (isset($aesSecretKeyCache['key']) && isset($aesSecretKeyCache['iv'])) {
            $key = $aesSecretKeyCache['key'];
            $ivValue = $aesSecretKeyCache['iv'];
            return base64_encode(openssl_encrypt($data, "AES-128-CBC", $key, true, $ivValue));
        }

        return '';
    }
    //AES解密
    public function decrypt(string $encode) : string
    {
        $cacheKey = self::AES_CACHE_ID;
        $aesSecretKeyCache = $this->get($cacheKey);
        if (isset($aesSecretKeyCache['key']) && isset($aesSecretKeyCache['iv'])) {
            $key = $aesSecretKeyCache['key'];
            $ivValue = $aesSecretKeyCache['iv'];
            return openssl_decrypt(base64_decode($encode), "AES-128-CBC", $key, true, $ivValue);
        }

        return '';
    }
}

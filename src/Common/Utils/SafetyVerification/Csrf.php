<?php
namespace Sdk\Common\Utils\SafetyVerification;

use Marmot\Core;
use Marmot\Framework\Query\DataCacheQuery;

use Sdk\Common\Utils\Cache\CsrfCache;
use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class Csrf extends DataCacheQuery
{
    const CSRF_TOKEN_LENGTH = 32;
    const CSRF_CACHE_ID = 'csrfToken';
    const EXPIRATION_TIME = 600;

    use CharacterGeneratorTrait;

    public function __construct()
    {
        parent::__construct(new CsrfCache());
    }

    public function generateToken() : string
    {
        $randomChar = $this->randomChar(self::CSRF_TOKEN_LENGTH);
        $csrfToken = md5($randomChar);
        
        $this->generateCacheToken($csrfToken);

        return $csrfToken;
    }

    //并行会话兼容
    protected function generateCacheToken(string $csrfToken) : bool
    {
        $cacheKey = self::CSRF_CACHE_ID.$csrfToken;

        return $this->save($cacheKey, $csrfToken, self::EXPIRATION_TIME);
    }

    public function verification(string $csrfToken)
    {
        $cacheKey = self::CSRF_CACHE_ID.$csrfToken;
        $csrfTokenCache = $this->get($cacheKey);

        if (empty($csrfTokenCache) || empty($csrfToken) || $csrfTokenCache!=$csrfToken) {
            Core::setLastError(CSRF_VERIFICATION_FAILURE);
            return false;
        }

        return true;
    }
}

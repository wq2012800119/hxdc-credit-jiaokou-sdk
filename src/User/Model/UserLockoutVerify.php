<?php
namespace Sdk\User\Model;

use Marmot\Core;
use Marmot\Framework\Query\DataCacheQuery;

use Sdk\User\Cache\UserLockoutVerifyCache;

class UserLockoutVerify extends DataCacheQuery
{
    const CACHE_KEY = 'USER_LOCKOUT';
    const FAILURE_MAX_COUNT = 10; //允许登录失败次数最多为10次
    const LOCKOUT_MAX_TIME = 30; //锁定时间为30分钟
    
    /**
     * @var string $client 登录客户端
     */
    private $client;
    /**
     * @var string $account 登录账号
     */
    private $account;
    /**
     * @var int $failureTime 登录失败时间
     */
    private $failureTime;
    /**
     * @var int $failureCount 登录失败次数
     */
    private $failureCount;

    public function __construct($account = '', $client = '')
    {
        parent::__construct(new UserLockoutVerifyCache());
        $this->client = empty($client) ? '' : $client;
        $this->account = empty($account) ? '' : $account;
        $this->failureTime = time();
        $this->failureCount = 0;
    }

    public function __destruct()
    {
        unset($this->client);
        unset($this->account);
        unset($this->failureTime);
        unset($this->failureCount);
    }

    public function getClient(): string
    {
        return $this->client;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function getFailureTime(): int
    {
        return $this->failureTime;
    }

    public function getFailureCount(): int
    {
        return $this->failureCount;
    }

    public function userLockoutVerify() : bool
    {
        $cacheKey = $this->getClient().self::CACHE_KEY.$this->getAccount();
        $data = $this->get($cacheKey);

        $minute = isset($data['failureTime']) ? floor((time() - $data['failureTime']) / 60) : 0;
        $failureCount = isset($data['failureCount']) ? $data['failureCount'] : 0;

        if ($failureCount >= self::FAILURE_MAX_COUNT) {
            if ($minute < self::LOCKOUT_MAX_TIME) {
                $minute = self::LOCKOUT_MAX_TIME - $minute;
                Core::setLastError(USER_ACCOUNT_LOCKED, array('pointer' => $minute));
                return false;
            }

            if ($minute >= self::FAILURE_MAX_COUNT) {
                $this->del($cacheKey);
            }
        }

        return true;
    }

    public function addFailureCount() : bool
    {
        $cacheKey = $this->getClient().self::CACHE_KEY.$this->getAccount();
        $data = $this->get($cacheKey);

        $failureCount = isset($data['failureCount']) ? $data['failureCount']+1 : 1;
        
        $data = array(
            'failureTime' => $this->getFailureTime(),
            'failureCount' => $failureCount
        );

        return $this->save($cacheKey, $data);
    }

    public function clearFailureCount() : bool
    {
        $cacheKey = $this->getClient().self::CACHE_KEY.$this->getAccount();
        return $this->del($cacheKey);
    }
}

<?php
namespace Sdk\User\Member\Model;

use Marmot\Core;
use Marmot\Framework\Classes\Cookie;
use Marmot\Framework\Query\DataCacheQuery;

use Sdk\User\Member\Cache\MemberCookieAuthCache;
use Sdk\User\Member\Repository\MemberRepository;
use Sdk\User\Member\Translator\MemberTranslator;

class MemberCookieAuth extends DataCacheQuery
{
    //过期时间-10分钟过期
    const EXPIRATION_TIME = 600;
    //过期时间-3天过期
    const COOKIE_EXPIRATION_TIME = 259200;
    const CACHE_KEY = 'MEMBER_CACHE';
    
    /**
     * @var string $name cookie name
     */
    private $name;
    /**
     * @var string $value cookie value
     */
    private $value;
    /**
     * @var string $domain cookie domain
     */
    private $domain;
    /**
     * @var int $expire cookie过期时间
     */
    private $expire;
    /**
     * @var int $path cookie path
     */
    private $path;
    /**
     * @var string $identify 唯一身份标识
     */
    private $identify;
    /**
     * @var int $uid 用户id
     */
    private $uid;

    private $cookie;

    private $repository;

    private $translator;

    public function __construct($uid = 0)
    {
        parent::__construct(new MemberCookieAuthCache());
        $this->name = Core::$container->get('cookie.name');
        $this->domain = Core::$container->get('cookie.domain');
        $this->path = Core::$container->get('cookie.path');
        $this->expire = Core::$container->get('time') + self::COOKIE_EXPIRATION_TIME;
        $this->identify = md5(uniqid('COOKIE').Core::$container->get('time'));
        $this->uid = empty($uid) ? 0 : $uid;
        $this->cookie = new Cookie($this->domain, $this->path);
        $this->repository = new MemberRepository();
        $this->translator = new MemberTranslator();
    }

    public function __destruct()
    {
        unset($this->name);
        unset($this->value);
        unset($this->domain);
        unset($this->path);
        unset($this->expire);
        unset($this->identify);
        unset($this->uid);
        unset($this->cookie);
        unset($this->repository);
        unset($this->translator);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getExpire(): int
    {
        return $this->expire;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    protected function getCookie() : Cookie
    {
        return $this->cookie;
    }

    protected function getRepository() : MemberRepository
    {
        return $this->repository;
    }

    protected function getTranslator() : MemberTranslator
    {
        return $this->translator;
    }

    public function saveCookieAndSaveMemberToCache(Member $member) : bool
    {
        $member->setIdentification($this->getIdentify());

        return $this->saveCookie($member) && $this->saveMemberToCache($member) && $this->initMember($member);
    }

    protected function saveCookie(Member $member) : bool
    {
        $cookie = $this->getCookie();
        $cookie->name = $this->getName();
        $cookie->value = $member->getId().':'.$this->getIdentify();
        $cookie->expire = $this->getExpire();

        return $cookie->add();
    }

    protected function saveMemberToCache(Member $member) : bool
    {
        $cacheKey = self::CACHE_KEY.$member->getId();
        $memberArray = $this->getTranslator()->objectToArray($member);
        
        return $this->save($cacheKey, $memberArray, self::EXPIRATION_TIME);
    }

    protected function initMember(Member $member) : bool
    {
        Core::$container->set('member', $member);
        return true;
    }

    public function verifyCookieAndInitUser() : bool
    {
        //验证cookie
        if ($this->verifyCookie()) {
            $member = $this->fetchMember();
            //验证身份标识
            if (!empty($this->getIdentify()) &&  $this->getIdentify() == $member->getIdentification()) {
                Core::$container->set('member', $member);
                return true;
            }
        }

        Core::$container->set('member', NullMember::getInstance());
        return false;
    }

    protected function verifyCookie() : bool
    {
        $cookie = $this->getCookie();
        $cookie->name = $this->getName();
        $cookie->get();
        $value = $cookie->value;
        $valueArray = explode(':', $value);

        $id = isset($valueArray['0']) ? $valueArray['0'] : 0;
        $identify = isset($valueArray['1']) ? $valueArray['1'] : '';
        
        if (empty($id) || empty($identify)) {
            return false;
        }

        $this->setUid($id);
        $this->setIdentify($identify);
        return true;
    }

    protected function fetchMember() : Member
    {
        $uid = $this->getUid();
        $cacheKey = self::CACHE_KEY.$uid;
        $data = $this->get($cacheKey);

        if (empty($data)) {
            $member = $this->getRepository()->scenario(MemberRepository::FETCH_ONE_MODEL_UN)->fetchOne($uid);
            $member->setIdentification($this->getIdentify());
        }

        if (!empty($data)) {
            $member = $this->getTranslator()->arrayToObject($data);
        }

        return $member;
    }

    public function clearCookieAndMemberToCache(Member $member) : bool
    {
        $cacheKey = self::CACHE_KEY.$member->getId();
        
        return $this->clearCookie() && $this->del($cacheKey);
    }

    protected function clearCookie() : bool
    {
        $cookie = $this->getCookie();
        $cookie->name = $this->getName();
        $cookie->value = '';
        $cookie->expire = -1;

        return $cookie->add();
    }
}

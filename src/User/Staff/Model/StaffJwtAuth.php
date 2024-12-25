<?php
namespace Sdk\User\Staff\Model;

use Marmot\Core;
use Marmot\Framework\Query\DataCacheQuery;

use Firebase\JWT\JWT;

use Sdk\User\Staff\Cache\StaffJwtAuthCache;
use Sdk\User\Staff\Repository\StaffRepository;
use Sdk\User\Staff\Translator\StaffTranslator;

class StaffJwtAuth extends DataCacheQuery
{
    //过期时间-10分钟过期
    const EXPIRATION_TIME = 600;
    //jwt过期时间-3天过期
    const JWT_EXPIRATION_TIME = 259200;
    const CACHE_KEY = 'STAFF_CACHE';
    
    /**
     * @var string $iss jwt的签发者
     */
    private $iss;
    /**
     * @var string $sub 面向的用户
     */
    private $sub;
    /**
     * @var string $aud 接收jwt的一方
     */
    private $aud;
    /**
     * @var int $exp token过期时间,过期时间要大于签发时间
     */
    private $exp;
    /**
     * @var int $nbf 当前时间在nbf设定时间之前，该token无法使用
     */
    private $nbf;
    /**
     * @var int jwt的签发时间
     */
    private $iat;
    /**
     * @var string $jti jwt的唯一身份标识
     */
    private $jti;
    /**
     * @var string $key 使用HMAC生成信息摘要时所使用的密钥
     */
    private $key;
    /**
     * @var int $uid 员工id
     */
    private $uid;

    private $repository;

    private $translator;

    public function __construct($uid = 0)
    {
        parent::__construct(new StaffJwtAuthCache());
        $this->iss = Core::$container->get('jwt.iss');
        $this->sub = Core::$container->get('jwt.sub');
        $this->aud = Core::$container->get('jwt.aud');
        $this->exp = Core::$container->get('time') + self::JWT_EXPIRATION_TIME;
        $this->nbf = Core::$container->get('time');
        $this->iat = Core::$container->get('time');
        $this->jti = md5(uniqid('JWT').Core::$container->get('time'));
        $this->key = Core::$container->get('jwt.key');
        $this->uid = empty($uid) ? 0 : $uid;
        $this->repository = new StaffRepository();
        $this->translator = new StaffTranslator();
    }

    public function __destruct()
    {
        unset($this->iss);
        unset($this->sub);
        unset($this->aud);
        unset($this->exp);
        unset($this->nbf);
        unset($this->iat);
        unset($this->jti);
        unset($this->key);
        unset($this->uid);
        unset($this->repository);
        unset($this->translator);
    }

    public function getIss(): string
    {
        return $this->iss;
    }

    public function getSub(): string
    {
        return $this->sub;
    }

    public function getAud(): string
    {
        return $this->aud;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

    public function getNbf(): int
    {
        return $this->nbf;
    }

    public function getIat(): int
    {
        return $this->iat;
    }

    public function setJti(string $jti): void
    {
        $this->jti = $jti;
    }

    public function getJti(): string
    {
        return $this->jti;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    protected function getRepository() : StaffRepository
    {
        return $this->repository;
    }

    protected function getTranslator() : StaffTranslator
    {
        return $this->translator;
    }

    public function generateJwtAndSaveStaffToCache(Staff $staff) : bool
    {
        $staff->setIdentification($this->getJti());

        return $this->generateJwt($staff) && $this->saveStaffToCache($staff) && $this->initStaff($staff);
    }

    protected function generateJwt(Staff $staff) : bool
    {
        $payload = array(
            'iss' => $this->getIss(),
            'sub' => $this->getSub(),
            'aud' => $this->getAud(),
            'exp' => $this->getExp(),
            'nbf' => $this->getNbf(),
            'iat' => $this->getIat(),
            'jti' => $this->getJti(),
            'uid' => $staff->getId()
        );

        $jwt = $this->fetchJwt($payload);
        Core::$container->set('jwt', $jwt);

        return true;
    }

    protected function fetchJwt(array $payload) : string
    {
        return JWT::encode($payload, $this->getKey());
    }

    protected function saveStaffToCache(Staff $staff) : bool
    {
        $cacheKey = self::CACHE_KEY.$staff->getId();
        $staffArray = $this->getTranslator()->objectToArray($staff);
        
        return $this->save($cacheKey, $staffArray, self::EXPIRATION_TIME);
    }

    protected function initStaff(Staff $staff) : bool
    {
        Core::$container->set('staff', $staff);
        return true;
    }

    public function verifyJwtAndInitUser(string $jwt) : bool
    {
        //验证jwt
        if ($this->verifyJwt($jwt)) {
            $staff = $this->fetchStaff();
            //验证身份标识
            if (!empty($this->getJti()) && $this->getJti() == $staff->getIdentification()) {
                Core::$container->set('staff', $staff);
                return true;
            }
        }

        Core::$container->set('staff', NullStaff::getInstance());
        return false;
    }

    protected function verifyJwt(string $jwt) : bool
    {
        try {
            JWT::$leeway = 60; // $leeway in seconds

            $decoded = JWT::decode($jwt, $this->getKey(), ['HS256']);
            $payload = (array)$decoded;
            if (isset($payload['uid'])) {
                $this->setUid($payload['uid']);
                $this->setJti($payload['jti']);
                return true;
            }
            
            return false;
        } catch (\UnexpectedValueException $e) {
            $e->getMessage();
            return false;
        }
    }

    protected function fetchStaff() : Staff
    {
        $uid = $this->getUid();
        $cacheKey = self::CACHE_KEY.$uid;
        $data = $this->get($cacheKey);

        if (empty($data)) {
            $staff = $this->getRepository()->scenario(StaffRepository::FETCH_ONE_MODEL_UN)->fetchOne($uid);
            $staff->setIdentification($this->getJti());
        }

        if (!empty($data)) {
            $staff = $this->getTranslator()->arrayToObject($data);
        }

        return $staff;
    }

    public function clearJwtAndStaffToCache(Staff $staff) : bool
    {
        $cacheKey = self::CACHE_KEY.$staff->getId();
        Core::$container->set('jwt', '');
        
        return $this->del($cacheKey);
    }
}

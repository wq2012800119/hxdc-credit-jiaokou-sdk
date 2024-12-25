<?php
namespace Sdk\User\Member\Model;

use Sdk\User\Model\User;
use Sdk\User\Member\Repository\MemberRepository;

class Member extends User
{
    /**
     * 性别
     * NULL => 0, 未知
     * MALE => 1, 男
     * FEMALE => 2 委办局用女户
     */
    const GENDER = array(
        'MALE' => 1,
        'FEMALE' => 2
    );
    const GENDER_CN = array(
        self::GENDER['MALE'] => '男',
        self::GENDER['FEMALE'] => '女'
    );

    /**
     * 认证状态
     * NATURAL_PERSON => 1, 个人认证
     * ENTERPRISE => 2, 企业认证
     * ALL => 3 个人认证和企业认证
     */
    const CERTIFICATE = array(
        'NATURAL_PERSON' => 1,
        'ENTERPRISE' => 2,
        'ALL' => 3
    );
    const CERTIFICATE_CN = array(
        self::CERTIFICATE['NATURAL_PERSON'] => '个人认证',
        self::CERTIFICATE['ENTERPRISE'] => '企业认证',
        self::CERTIFICATE['ALL'] => '个人认证和企业认证',
    );
    
    /**
     * 密保问题
     * QUESTION_ONE_FAVORITE_COLOR => 1, 你最喜欢的颜色
     * QUESTION_TWO_FAVORITE_SONGS => 2, 你最喜欢的歌曲
     * QUESTION_THREE_FAVORITE_MOVIES => 3, 你最喜欢的电影
     * QUESTION_FOUR_FAVORITE_FOOD => 4, 你最喜欢的食物
     * QUESTION_FIVE_FAVORITE_ANIMAL => 5, 你最喜欢的动物
     */
    const QUESTION = array(
        'QUESTION_ONE_FAVORITE_COLOR' => 1,
        'QUESTION_TWO_FAVORITE_SONGS' => 2,
        'QUESTION_THREE_FAVORITE_MOVIES' => 3,
        'QUESTION_FOUR_FAVORITE_FOOD' => 4,
        'QUESTION_FIVE_FAVORITE_ANIMAL' => 5,
    );
    const QUESTION_CN = array(
        self::QUESTION['QUESTION_ONE_FAVORITE_COLOR'] => '你最喜欢的颜色',
        self::QUESTION['QUESTION_TWO_FAVORITE_SONGS'] => '你最喜欢的歌曲',
        self::QUESTION['QUESTION_THREE_FAVORITE_MOVIES'] => '你最喜欢的电影',
        self::QUESTION['QUESTION_FOUR_FAVORITE_FOOD'] => '你最喜欢的食物',
        self::QUESTION['QUESTION_FIVE_FAVORITE_ANIMAL'] => '你最喜欢的动物',
    );
    
    /**
     * @var int $gender 性别
     */
    private $gender;
    /**
     * @var string $email 邮箱
     */
    private $email;
    /**
     * @var string $address 地址
     */
    private $address;
    /**
     * @var int $question 密保问题
     */
    private $question;
    /**
     * @var string $answer 密保答案
     */
    private $answer;
    /**
     * @var int $identification 身份标识
     */
    private $identification;
    /**
     * @var int $certificate 认证状态
     */
    private $certificate;

    private $repository;

    private $memberCookieAuth;

    private $memberJwtAuth;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->gender = 0;
        $this->email = '';
        $this->address = '';
        $this->question = 0;
        $this->answer = '';
        $this->identification = '';
        $this->certificate = 0;
        $this->repository = new MemberRepository();
        $this->memberCookieAuth = new MemberCookieAuth();
        $this->memberJwtAuth = new MemberJwtAuth();
    }

    public function __destruct()
    {
        unset($this->gender);
        unset($this->email);
        unset($this->address);
        unset($this->question);
        unset($this->answer);
        unset($this->identification);
        unset($this->certificate);
        unset($this->repository);
        unset($this->memberCookieAuth);
        unset($this->memberJwtAuth);
    }

    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setQuestion(int $question): void
    {
        $this->question = $question;
    }

    public function getQuestion(): int
    {
        return $this->question;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }
    
    public function setCertificate(int $certificate): void
    {
        $this->certificate = $certificate;
    }

    public function getCertificate(): int
    {
        return $this->certificate;
    }

    protected function getRepository() : MemberRepository
    {
        return $this->repository;
    }

    protected function getMemberCookieAuth() : MemberCookieAuth
    {
        return $this->memberCookieAuth;
    }

    protected function getMemberJwtAuth() : MemberJwtAuth
    {
        return $this->memberJwtAuth;
    }
    
    public function login() : bool
    {
        return $this->getRepository()->login($this)
            && $this->getMemberCookieAuth()->saveCookieAndSaveMemberToCache($this);
    }

    public function logout() : bool
    {
        return $this->getMemberCookieAuth()->clearCookieAndMemberToCache($this);
    }

    public function loginGateway() : bool
    {
        return $this->getRepository()->login($this)
            && $this->getMemberJwtAuth()->generateJwtAndSaveMemberToCache($this);
    }

    public function logoutGateway() : bool
    {
        return $this->getMemberJwtAuth()->clearJwtAndMemberToCache($this);
    }

    public function validateAnswer() : bool
    {
        return $this->getRepository()->validateAnswer($this);
    }

    public function updateSecurityQuestion() : bool
    {
        return $this->getRepository()->updateSecurityQuestion($this);
    }

    public function validatePassword() : bool
    {
        return $this->getRepository()->login($this);
    }
}

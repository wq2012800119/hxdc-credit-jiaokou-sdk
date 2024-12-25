<?php
namespace Sdk\User\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

abstract class User implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    private $id;
    /**
     * @var string $subjectName 姓名
     */
    private $subjectName;
    /**
     * @var string $cellphone 手机号
     */
    private $cellphone;
    /**
     * @var string $idCard 身份证号
     */
    private $idCard;
    /**
     * @var string $password 密码
     */
    private $password;
    /**
     * @var string $oldPassword 密码
     */
    private $oldPassword;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->subjectName = '';
        $this->cellphone = '';
        $this->idCard = '';
        $this->password = '';
        $this->oldPassword = '';
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->cellphone);
        unset($this->idCard);
        unset($this->password);
        unset($this->oldPassword);
        unset($this->status);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setCellphone(string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function setIdCard(string $idCard): void
    {
        $this->idCard = $idCard;
    }

    public function getIdCard(): string
    {
        return $this->idCard;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setOldPassword(string $oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    abstract protected function getRepository();

    public function resetPassword() : bool
    {
        return $this->getRepository()->resetPassword($this);
    }

    public function updatePassword() : bool
    {
        return $this->getRepository()->updatePassword($this);
    }
}

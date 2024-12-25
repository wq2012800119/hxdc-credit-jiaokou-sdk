<?php
namespace Sdk\Interaction\CommonInteraction\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\User\Member\Model\Member;

abstract class CommonInteraction implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;

    /**
     * 受理状态
     * UN_ACCEPTED 未受理
     * REVOKED 已撤销
     * ACCEPTED 已受理
     */
    const REPLY_STATUS = array(
        'UN_ACCEPTED' => 0,
        'REVOKED' => -2,
        'ACCEPTED' => 2
    );

    const REPLY_STATUS_CN = array(
        self::REPLY_STATUS['UN_ACCEPTED'] => '未受理',
        self::REPLY_STATUS['REVOKED'] => '已撤销',
        self::REPLY_STATUS['ACCEPTED'] => '已受理'
    );

    private $id;
    /**
     * @var string $realName 真实姓名
     */
    private $realName;
    /**
     * @var string $cellphone 联系电话
     */
    private $cellphone;
    /**
     * @var string $email 电子邮箱
     */
    private $email;
    /**
     * @var string $title 标题描述
     */
    private $title;
    /**
     * @var string $content 内容描述
     */
    private $content;
    /**
     * @var int $replyStatus 受理状态
     */
    private $replyStatus;
    /**
     * @var int $replyTime 答复时间
     */
    private $replyTime;
    /**
     * @var string $replyContent 答复内容
     */
    private $replyContent;
    /**
     * @var Organization $organization 答复单位
     */
    private $organization;
    /**
     * @var Staff $staff 答复人
     */
    private $staff;
    /**
     * @var Member $member 发布用户
     */
    private $member;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->realName = '';
        $this->cellphone = '';
        $this->email = '';
        $this->title = '';
        $this->content = '';
        $this->replyStatus = 0;
        $this->replyTime = 0;
        $this->replyContent = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->realName);
        unset($this->cellphone);
        unset($this->email);
        unset($this->title);
        unset($this->content);
        unset($this->replyStatus);
        unset($this->replyTime);
        unset($this->replyContent);
        unset($this->organization);
        unset($this->staff);
        unset($this->member);
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

    public function setRealName(string $realName): void
    {
        $this->realName = $realName;
    }

    public function getRealName(): string
    {
        return $this->realName;
    }

    public function setCellphone(string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setReplyStatus(int $replyStatus): void
    {
        $this->replyStatus = $replyStatus;
    }

    public function getReplyStatus(): int
    {
        return $this->replyStatus;
    }

    public function setReplyTime(int $replyTime): void
    {
        $this->replyTime = $replyTime;
    }

    public function getReplyTime(): int
    {
        return $this->replyTime;
    }

    public function setReplyContent(string $replyContent): void
    {
        $this->replyContent = $replyContent;
    }

    public function getReplyContent(): string
    {
        return $this->replyContent;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setMember(Member $member): void
    {
        $this->member = $member;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    abstract protected function getRepository();

    public function update() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function enable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function disable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function accept() : bool
    {
        return $this->getRepository()->accept($this);
    }

    public function forward() : bool
    {
        return $this->getRepository()->forward($this);
    }

    public function revoke() : bool
    {
        if ($this->getMember()->getId() != Core::$container->get('member')->getId()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->revoke($this);
    }
}

<?php
namespace Sdk\Member\ResourceData\Model;

use Marmot\Core;

use Sdk\User\Member\Model\Member;

use Sdk\Resource\Data\Model\Data;
use Sdk\Member\ResourceData\Repository\ResourceDataRepository;

class ResourceData extends Data
{
    /**
     * 认证类型
     * NATURAL_PERSON 个人认证
     * ENTERPRISE 企业认证
     */
    const CERTIFICATE_TYPE = array(
        'NATURAL_PERSON' => 1,
        'ENTERPRISE' => 2
    );

    const CERTIFICATE_TYPE_CN = array(
        self::CERTIFICATE_TYPE['NATURAL_PERSON'] => '个人认证',
        self::CERTIFICATE_TYPE['ENTERPRISE'] => '企业认证'
    );
    
    const RESOURCE_DATA_EXAMINE_STATUS = array(
        'PENDING' => 0,
        'APPROVE' => 2,
        'REVOKE' => -1,
        'REJECT' => -2
    );

    const RESOURCE_DATA_EXAMINE_STATUS_CN = array(
        self::RESOURCE_DATA_EXAMINE_STATUS['PENDING'] => '待审核',
        self::RESOURCE_DATA_EXAMINE_STATUS['APPROVE'] => '已通过',
        self::RESOURCE_DATA_EXAMINE_STATUS['REVOKE'] => '已撤销',
        self::RESOURCE_DATA_EXAMINE_STATUS['REJECT'] => '已驳回'
    );

    const RESOURCE_DATA_EXAMINE_STATUS_TYPE = array(
        self::RESOURCE_DATA_EXAMINE_STATUS['PENDING'] => 'warning',
        self::RESOURCE_DATA_EXAMINE_STATUS['APPROVE'] => 'success',
        self::RESOURCE_DATA_EXAMINE_STATUS['REVOKE'] => 'danger',
        self::RESOURCE_DATA_EXAMINE_STATUS['REJECT'] => 'danger'
    );
    /**
     * @var array $attachments 附件
     */
    private $attachments;
    /**
     * @var int $certificateType 认证类型
     */
    private $certificateType;
    /**
     * @var int $certificateId 用户认证id
     */
    private $certificateId;
    /**
     * @var string $rejectReason 驳回原因
     */
    private $rejectReason;
    /**
     * @var Member $member 申请用户
     */
    private $member;

    private $repository;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        $this->attachments = array();
        $this->certificateType = 0;
        $this->certificateId = 0;
        $this->rejectReason = '';
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->repository = new ResourceDataRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->attachments);
        unset($this->certificateType);
        unset($this->certificateId);
        unset($this->rejectReason);
        unset($this->member);
        unset($this->repository);
    }

    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function setCertificateType(int $certificateType): void
    {
        $this->certificateType = $certificateType;
    }

    public function getCertificateType(): int
    {
        return $this->certificateType;
    }

    public function setCertificateId(int $certificateId): void
    {
        $this->certificateId = $certificateId;
    }

    public function getCertificateId(): int
    {
        return $this->certificateId;
    }

    public function setRejectReason(string $rejectReason): void
    {
        $this->rejectReason = $rejectReason;
    }

    public function getRejectReason(): string
    {
        return $this->rejectReason;
    }

    public function setMember(Member $member): void
    {
        $this->member = $member;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function setExamineStatus(int $examineStatus): void
    {
        $this->examineStatus = in_array(
            $examineStatus,
            self::RESOURCE_DATA_EXAMINE_STATUS
        ) ? $examineStatus : self::RESOURCE_DATA_EXAMINE_STATUS['PENDING'];
    }

    public function getExamineStatus(): int
    {
        return $this->examineStatus;
    }

    protected function getRepository()
    {
        return $this->repository;
    }

    public function update() : bool
    {
        return $this->getRepository()->update($this);
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

<?php
namespace Sdk\Member\Commitment\Model;

use Marmot\Core;

use Sdk\User\Member\Model\Member;

use Sdk\Member\Commitment\Repository\CommitmentRepository;
use Sdk\Application\Commitment\Model\Commitment as ApplicationCommitment;

class Commitment extends ApplicationCommitment
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

    const COMMITMENT_EXAMINE_STATUS = array(
        'PENDING' => 0,
        'APPROVE' => 2,
        'REVOKE' => -1,
        'REJECT' => -2
    );

    const COMMITMENT_EXAMINE_STATUS_CN = array(
        self::COMMITMENT_EXAMINE_STATUS['PENDING'] => '待审核',
        self::COMMITMENT_EXAMINE_STATUS['APPROVE'] => '已通过',
        self::COMMITMENT_EXAMINE_STATUS['REVOKE'] => '已撤销',
        self::COMMITMENT_EXAMINE_STATUS['REJECT'] => '已驳回'
    );

    const COMMITMENT_EXAMINE_STATUS_TYPE = array(
        self::COMMITMENT_EXAMINE_STATUS['PENDING'] => 'warning',
        self::COMMITMENT_EXAMINE_STATUS['APPROVE'] => 'success',
        self::COMMITMENT_EXAMINE_STATUS['REVOKE'] => 'danger',
        self::COMMITMENT_EXAMINE_STATUS['REJECT'] => 'danger'
    );
    /**
     * @var int $certificateType 认证类型
     */
    private $certificateType;
    /**
     * @var int $certificateId 用户认证id
     */
    private $certificateId;
    /**
     * @var array $attachments 附件
     */
    private $attachments;
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
        $this->certificateType = 0;
        $this->certificateId = 0;
        $this->attachments = array();
        $this->rejectReason = '';
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->repository = new CommitmentRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->certificateType);
        unset($this->certificateId);
        unset($this->attachments);
        unset($this->rejectReason);
        unset($this->member);
        unset($this->repository);
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

    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
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
            self::COMMITMENT_EXAMINE_STATUS
        ) ? $examineStatus : self::COMMITMENT_EXAMINE_STATUS['PENDING'];
    }

    public function getExamineStatus(): int
    {
        return $this->examineStatus;
    }

    protected function getRepository()
    {
        return $this->repository;
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

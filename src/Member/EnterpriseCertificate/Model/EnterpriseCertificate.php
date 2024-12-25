<?php
namespace Sdk\Member\EnterpriseCertificate\Model;

use Marmot\Core;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\User\Member\Model\Member;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Member\EnterpriseCertificate\Repository\EnterpriseCertificateRepository;

class EnterpriseCertificate extends Enterprise implements IOperateAble, IExamineAble
{
    use OperateAbleTrait, ExamineAbleTrait;

    /**
     * @var string $businessLicensePicture 营业执照图片
     */
    private $businessLicensePicture;
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
        $this->businessLicensePicture = '';
        $this->rejectReason = '';
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->repository = new EnterpriseCertificateRepository();
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->businessLicensePicture);
        unset($this->rejectReason);
        unset($this->member);
        unset($this->examineStatus);
        unset($this->repository);
    }

    public function setBusinessLicensePicture(string $businessLicensePicture): void
    {
        $this->businessLicensePicture = $businessLicensePicture;
    }

    public function getBusinessLicensePicture(): string
    {
        return $this->businessLicensePicture;
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

    protected function getRepository() : EnterpriseCertificateRepository
    {
        return $this->repository;
    }
}

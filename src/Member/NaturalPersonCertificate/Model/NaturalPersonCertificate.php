<?php
namespace Sdk\Member\NaturalPersonCertificate\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\ExamineAbleTrait;
use Sdk\Common\Model\Interfaces\IExamineAble;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Member\NaturalPersonCertificate\Repository\NaturalPersonCertificateRepository;

use Sdk\User\Member\Model\Member;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class NaturalPersonCertificate implements IObject, IOperateAble, IExamineAble
{
    use Object, OperateAbleTrait, ExamineAbleTrait;

    private $id;
    /**
     * @var string $subjectName 姓名
     */
    private $subjectName;
    /**
     * @var string $idCard 身份证
     */
    private $idCard;
    /**
     * @var string $frontIdCardPic 身份证正面图片地址
     */
    private $frontIdCardPic;
    /**
     * @var string $backIdCardPic 身份证反面图片地址
     */
    private $backIdCardPic;
    /**
     * @var string $handheldIdCardPic 手持身份证图片地址
     */
    private $handheldIdCardPic;
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
        $this->id = !empty($id) ? $id : 0;
        $this->subjectName = '';
        $this->idCard = '';
        $this->frontIdCardPic = '';
        $this->backIdCardPic = '';
        $this->handheldIdCardPic = '';
        $this->rejectReason = '';
        $this->member = Core::$container->has('member') ? Core::$container->get('member') : new Member();
        $this->status = self::STATUS['ENABLED'];
        $this->examineStatus = self::EXAMINE_STATUS['PENDING'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new NaturalPersonCertificateRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->subjectName);
        unset($this->idCard);
        unset($this->frontIdCardPic);
        unset($this->backIdCardPic);
        unset($this->handheldIdCardPic);
        unset($this->rejectReason);
        unset($this->member);
        unset($this->status);
        unset($this->examineStatus);
        unset($this->createTime);
        unset($this->updateTime);
        unset($this->statusTime);
        unset($this->repository);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setIdCard(string $idCard): void
    {
        $this->idCard = $idCard;
    }

    public function getIdCard(): string
    {
        return $this->idCard;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setFrontIdCardPic(string $frontIdCardPic): void
    {
        $this->frontIdCardPic = $frontIdCardPic;
    }

    public function getFrontIdCardPic(): string
    {
        return $this->frontIdCardPic;
    }
    
    public function setBackIdCardPic(string $backIdCardPic): void
    {
        $this->backIdCardPic = $backIdCardPic;
    }

    public function getBackIdCardPic(): string
    {
        return $this->backIdCardPic;
    }
    
    public function setHandheldIdCardPic(string $handheldIdCardPic): void
    {
        $this->handheldIdCardPic = $handheldIdCardPic;
    }

    public function getHandheldIdCardPic(): string
    {
        return $this->handheldIdCardPic;
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

    protected function getRepository() : NaturalPersonCertificateRepository
    {
        return $this->repository;
    }
}

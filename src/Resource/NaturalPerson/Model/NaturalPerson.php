<?php
namespace Sdk\Resource\NaturalPerson\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\Resource\Data\Model\Data;

use Sdk\Resource\NaturalPerson\Repository\NaturalPersonRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 *
 */
class NaturalPerson implements IObject
{
    use Object;

    /**
     * 授权状态
     * UN_AUTHORIZE 未授权
     * AUTHORIZE 已授权
     */
    const AUTHORIZATION = array(
        'UN_AUTHORIZE' => 0,
        'AUTHORIZE' => 2,
    );

    const AUTHORIZATION_CN = array(
        self::AUTHORIZATION['UN_AUTHORIZE'] => '未授权',
        self::AUTHORIZATION['AUTHORIZE'] => '已授权'
    );
    
    const AUTHORIZATION_TYPE = array(
        self::AUTHORIZATION['UN_AUTHORIZE'] => 'danger',
        self::AUTHORIZATION['AUTHORIZE'] => 'success'
    );

    private $id;
    /**
     * @var string $ztmc 主体名称
     */
    private $ztmc;
    /**
     * @var string $cym 曾用名
     */
    private $cym;
    /**
     * @var string $zjhm 证件号码
     */
    private $zjhm;
    /**
     * @var string $xb 性别
     */
    private $xb;
    /**
     * @var int $csrq 出生日期
     */
    private $csrq;
    /**
     * @var string $cssj 出生时间
     */
    private $cssj;
    /**
     * @var string $csdgj 出生地国家
     */
    private $csdgj;
    /**
     * @var string $csdssx 出生地省市县
     */
    private $csdssx;
    /**
     * @var string $jggj 籍贯国家
     */
    private $jggj;
    /**
     * @var string $jgssx 籍贯省市县
     */
    private $jgssx;
    /**
     * @var int $swrq 死亡日期
     */
    private $swrq;
    /**
     * @var int $qcrq 迁出日期
     */
    private $qcrq;
    /**
     * @var string $hb 户别
     */
    private $hb;
    /**
     * @var string $hh 户号
     */
    private $hh;
    /**
     * @var string $yhzgx 与户主关系
     */
    private $yhzgx;
    /**
     * @var string $ryzt 人员状态
     */
    private $ryzt;
    /**
     * @var string $pcs 派出所
     */
    private $pcs;
    /**
     * @var string $jlx 街路巷
     */
    private $jlx;
    /**
     * @var string $mlph 门楼牌号
     */
    private $mlph;
    /**
     * @var string $mlxz 门口详址
     */
    private $mlxz;
    /**
     * @var string $xzjd 乡镇街道
     */
    private $xzjd;
    /**
     * @var string $jcwh 居（村）委会
     */
    private $jcwh;
    /**
     * @var string $mz 民族
     */
    private $mz;
    /**
     * @var int $authorization 授权状态
     */
    private $authorization;
    /**
     * @var Data $source 资源目录relation 关联 id
     */
    private $source;

    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->ztmc = '';
        $this->cym = '';
        $this->zjhm = '';
        $this->xb = '';
        $this->csrq = 0;
        $this->cssj = '';
        $this->csdgj = '';
        $this->csdssx = '';
        $this->jggj = '';
        $this->jgssx = '';
        $this->swrq = 0;
        $this->qcrq = 0;
        $this->hb = '';
        $this->hh = '';
        $this->yhzgx = '';
        $this->ryzt = '';
        $this->pcs = '';
        $this->jlx = '';
        $this->mlph = '';
        $this->mlxz = '';
        $this->xzjd = '';
        $this->jcwh = '';
        $this->mz = '';
        $this->authorization = 0;
        $this->source = new Data();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new NaturalPersonRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->ztmc);
        unset($this->cym);
        unset($this->zjhm);
        unset($this->xb);
        unset($this->csrq);
        unset($this->cssj);
        unset($this->csdgj);
        unset($this->csdssx);
        unset($this->jggj);
        unset($this->jgssx);
        unset($this->swrq);
        unset($this->qcrq);
        unset($this->hb);
        unset($this->hh);
        unset($this->yhzgx);
        unset($this->ryzt);
        unset($this->pcs);
        unset($this->jlx);
        unset($this->mlph);
        unset($this->mlxz);
        unset($this->xzjd);
        unset($this->jcwh);
        unset($this->mz);
        unset($this->authorization);
        unset($this->source);
        unset($this->status);
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

    public function setZtmc(string $ztmc): void
    {
        $this->ztmc = $ztmc;
    }

    public function getZtmc(): string
    {
        return $this->ztmc;
    }

    public function setCym(string $cym): void
    {
        $this->cym = $cym;
    }

    public function getCym(): string
    {
        return $this->cym;
    }

    public function setZjhm(string $zjhm): void
    {
        $this->zjhm = $zjhm;
    }

    public function getZjhm(): string
    {
        return $this->zjhm;
    }

    public function setXb(string $xb): void
    {
        $this->xb = $xb;
    }

    public function getXb(): string
    {
        return $this->xb;
    }

    public function setCsrq(int $csrq): void
    {
        $this->csrq = $csrq;
    }

    public function getCsrq(): int
    {
        return $this->csrq;
    }

    public function setCssj(string $cssj): void
    {
        $this->cssj = $cssj;
    }

    public function getCssj(): string
    {
        return $this->cssj;
    }

    public function setCsdgj(string $csdgj): void
    {
        $this->csdgj = $csdgj;
    }

    public function getCsdgj(): string
    {
        return $this->csdgj;
    }

    public function setCsdssx(string $csdssx): void
    {
        $this->csdssx = $csdssx;
    }

    public function getCsdssx(): string
    {
        return $this->csdssx;
    }

    public function setJggj(string $jggj): void
    {
        $this->jggj = $jggj;
    }

    public function getJggj(): string
    {
        return $this->jggj;
    }

    public function setJgssx(string $jgssx): void
    {
        $this->jgssx = $jgssx;
    }

    public function getJgssx(): string
    {
        return $this->jgssx;
    }

    public function setSwrq(int $swrq): void
    {
        $this->swrq = $swrq;
    }

    public function getSwrq(): int
    {
        return $this->swrq;
    }

    public function setQcrq(int $qcrq): void
    {
        $this->qcrq = $qcrq;
    }

    public function getQcrq(): int
    {
        return $this->qcrq;
    }

    public function setHb(string $hb): void
    {
        $this->hb = $hb;
    }

    public function getHb(): string
    {
        return $this->hb;
    }

    public function setHh(string $hh): void
    {
        $this->hh = $hh;
    }

    public function getHh(): string
    {
        return $this->hh;
    }

    public function setYhzgx(string $yhzgx): void
    {
        $this->yhzgx = $yhzgx;
    }

    public function getYhzgx(): string
    {
        return $this->yhzgx;
    }

    public function setRyzt(string $ryzt): void
    {
        $this->ryzt = $ryzt;
    }

    public function getRyzt(): string
    {
        return $this->ryzt;
    }

    public function setPcs(string $pcs): void
    {
        $this->pcs = $pcs;
    }

    public function getPcs(): string
    {
        return $this->pcs;
    }

    public function setJlx(string $jlx): void
    {
        $this->jlx = $jlx;
    }

    public function getJlx(): string
    {
        return $this->jlx;
    }

    public function setMlph(string $mlph): void
    {
        $this->mlph = $mlph;
    }

    public function getMlph(): string
    {
        return $this->mlph;
    }

    public function setMlxz(string $mlxz): void
    {
        $this->mlxz = $mlxz;
    }

    public function getMlxz(): string
    {
        return $this->mlxz;
    }

    public function setXzjd(string $xzjd): void
    {
        $this->xzjd = $xzjd;
    }

    public function getXzjd(): string
    {
        return $this->xzjd;
    }

    public function setJcwh(string $jcwh): void
    {
        $this->jcwh = $jcwh;
    }

    public function getJcwh(): string
    {
        return $this->jcwh;
    }

    public function setMz(string $mz): void
    {
        $this->mz = $mz;
    }

    public function getMz(): string
    {
        return $this->mz;
    }

    public function setAuthorization(int $authorization): void
    {
        $this->authorization = $authorization;
    }

    public function getAuthorization(): int
    {
        return $this->authorization;
    }

    public function setSource(Data $source): void
    {
        $this->source = $source;
    }

    public function getSource(): Data
    {
        return $this->source;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    protected function getRepository() : NaturalPersonRepository
    {
        return $this->repository;
    }

    public function authorize() : bool
    {
        if ($this->isAuthorize()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->authorize($this);
    }

    public function unAuthorize() : bool
    {
        if (!$this->isAuthorize()) {
            Core::setLastError(RESOURCE_CAN_NOT_MODIFY);
            return false;
        }

        return $this->getRepository()->unAuthorize($this);
    }

    public function isAuthorize() : bool
    {
        return $this->getAuthorization() == self::AUTHORIZATION['AUTHORIZE'];
    }
}

<?php
namespace Sdk\CreditReport\CommonConfig\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\CreditReport\CommonConfig\Repository\CommonConfigRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

class CommonConfig implements IObject
{
    use Object;

    //经营（活动）异常名录（状态）信息
    const ENTERPRISE_ABNORMAL_INFO_DIRECTORIES = array(
        'JYYCMLXX' => 27 //经营异常名录信息
    );

    //信用评价信息
    const ENTERPRISE_CREDIT_EVALUATION_INFO_DIRECTORIES = array(
        'GGXYZHPJJG' => 20 //公共信用综合评价结果
    );

    //司法判决及执行信息
    const ENTERPRISE_JUDICIAL_DECISION_INFO_DIRECTORIES = array(
        'SFPJXX' => 29 //司法判决信息
    );
    const NATURAL_PERSON_JUDICIAL_DECISION_INFO_DIRECTORIES = array(
        'SFPJXX' => 29 //司法判决信息
    );

    //职称和职业资格信息
    const NATURAL_PERSON_QUALIFICATION_INFO_DIRECTORIES = array(
        'HSZYZXX' => 21, //执业医师证信息
        'YSZYZXX' => 22, //执业药师证信息
        'LSZYZXX' => 23, //律师执业证信息
        'GZYZYZXX' => 24, //公证员执业证信息
        'ZYZGXX' => 40 //职业资格信息
    );

    const DIY_CONTENT_DIRECTORY_TYPE_KEYS = array(
        'administrationInfo', 'honorInfo', 'dishonestyInfo', 'abnormalInfo', 'creditEvaluationInfo',
        'judicialDecisionInfo', 'qualificationInfo', 'otherInfo', 'localAdditionalContent'
    );

    const DIY_CONTENT_DIRECTORY_TYPE_KEYS_SORT = array(
        'basicInfo', 'administrationInfo', 'honorInfo', 'dishonestyInfo', 'abnormalInfo',
        'commitmentInfo', 'creditEvaluationInfo', 'judicialDecisionInfo', 'qualificationInfo',
        'otherInfo', 'improveSuggestion', 'localAdditionalContent'
    );

    const DIY_CONTENT_NUMBER = array(
        1 => '一',
        2 => '二',
        3 => '三',
        4 => '四',
        5 => '五',
        6 => '六',
        7 => '七',
        8 => '八',
        9 => '九',
        10 => '十',
        11 => '十一',
        12 => '十二',
    );

    private $id;
    /**
     * @var array $diyContent 自定义内容
     */
    private $diyContent;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->diyContent = array();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new CommonConfigRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->diyContent);
        unset($this->staff);
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

    public function setDiyContent(array $diyContent): void
    {
        $this->diyContent = $diyContent;
    }

    public function getDiyContent(): array
    {
        return $this->diyContent;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
    
    protected function getRepository() : CommonConfigRepository
    {
        return $this->repository;
    }

    public function updateEnterpriseConfig() : bool
    {
        return $this->getRepository()->updateEnterpriseConfig($this);
    }

    public function updateNaturalPersonConfig() : bool
    {
        return $this->getRepository()->updateNaturalPersonConfig($this);
    }
}

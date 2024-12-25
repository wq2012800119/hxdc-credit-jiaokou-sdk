<?php
namespace Sdk\Evaluation\Scenario\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;
use Sdk\Common\Model\Traits\OperateAbleTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\Scenario\Repository\ScenarioRepository;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Organization\Organization\Model\Organization;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;

class Scenario implements IObject, IOperateAble
{
    use Object, OperateAbleTrait;
    
    private $id;
    /**
     * @var string $name 名称
     */
    private $name;
    /**
     * @var string $description 说明
     */
    private $description;
    /**
     * @var Organization $organization 发布委办局
     */
    private $organization;
    /**
     * @var Staff $staff 发布人
     */
    private $staff;
    /**
     * @var ScoreModel $scoreModel 关联评价模型
     */
    private $scoreModel;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->description = '';
        $this->organization = new Organization();
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->scoreModel = new ScoreModel();
        $this->status = self::STATUS['ENABLED'];
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new ScenarioRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->description);
        unset($this->organization);
        unset($this->staff);
        unset($this->scoreModel);
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setScoreModel(ScoreModel $scoreModel): void
    {
        $this->scoreModel = $scoreModel;
    }

    public function getScoreModel(): ScoreModel
    {
        return $this->scoreModel;
    }
    
    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function getRepository() : ScenarioRepository
    {
        return $this->repository;
    }
}

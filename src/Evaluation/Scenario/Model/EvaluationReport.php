<?php
namespace Sdk\Evaluation\Scenario\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\Evaluation\Scenario\Repository\EvaluationReportRepository;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;

class EvaluationReport implements IObject
{
    use Object;
    
    private $id;
    /**
     * @var Enterprise $enterprise 企业
     */
    private $enterprise;
    /**
     * @var NaturalPerson $naturalPerson 自然人
     */
    private $naturalPerson;
    /**
     * @var array $indicatorResults 评分结果
     */
    private $indicatorResults;
    /**
     * @var string $rating 等级
     */
    private $rating;
    /**
     * @var int $score 总分
     */
    private $score;
    /**
     * @var ScoreModel $scoreModel 评分模型
     */
    private $scoreModel;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->enterprise = new Enterprise();
        $this->naturalPerson = new NaturalPerson();
        $this->indicatorResults = array();
        $this->scoreModel = new ScoreModel();
        $this->rating = '';
        $this->score = 0;
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new EvaluationReportRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->enterprise);
        unset($this->naturalPerson);
        unset($this->indicatorResults);
        unset($this->scoreModel);
        unset($this->rating);
        unset($this->score);
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

    public function setEnterprise(Enterprise $enterprise): void
    {
        $this->enterprise = $enterprise;
    }

    public function getEnterprise(): Enterprise
    {
        return $this->enterprise;
    }

    public function setNaturalPerson(NaturalPerson $naturalPerson): void
    {
        $this->naturalPerson = $naturalPerson;
    }

    public function getNaturalPerson(): NaturalPerson
    {
        return $this->naturalPerson;
    }

    public function setScoreModel(ScoreModel $scoreModel): void
    {
        $this->scoreModel = $scoreModel;
    }

    public function getScoreModel(): ScoreModel
    {
        return $this->scoreModel;
    }

    public function setIndicatorResults(array $indicatorResults): void
    {
        $this->indicatorResults = $indicatorResults;
    }

    public function getIndicatorResults(): array
    {
        return $this->indicatorResults;
    }

    public function setRating(string $rating): void
    {
        $this->rating = $rating;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }
    
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    protected function getRepository() : EvaluationReportRepository
    {
        return $this->repository;
    }

    public function evaluate() : bool
    {
        return $this->getRepository()->evaluate($this);
    }
}

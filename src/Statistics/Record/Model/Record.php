<?php
namespace Sdk\Statistics\Record\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

class Record implements IObject
{
    use Object;

    /**
     * 分类
     * HOME-OA oa驾驶舱
     * ARTICLE-OA oa新闻统计
     * COMMITMENT-OA oa信用承诺数据统计
     * COMMITMENT-PORTAL 门户信用承诺统计
     * DIRECTORY-OA oa信用目录统计
     * RESOURCE-DATA-OA oa信用数据统计
     * CREDIT-REPORT-OA oa报告应用数据统计
     * RAP-OA oa联合奖惩数据统计
     * INTERACTION-OA oa互动交流数据统计
     * CREDIT-MODULE-OA oa信用+应用管理数据统计
     * CONTRACT-PERFORMANCE-OA oa合同履约数据统计
     * RESOURCE-RANDOM-OA oa双随机一公开数据统计
     * RESOURCE-PUBLICATION-OA oa十公示数据统计
     * CREDIT-RECORD-OA oa信用记录数据统计
     * MEMBER-SELF-DECLARATION-OA oa信用自主申报统计
     * RESOURCE-PUBLICATION-QUALITY-ANALYSIS-OA oa十公示数据质量分析统计
     */
    const CATEGORY = array(
        'HOME-OA' => 9,
        'ARTICLE-OA' => 10,
        'COMMITMENT-OA' => 20,
        'COMMITMENT-PORTAL' => 21,
        'DIRECTORY-OA' => 30,
        'RESOURCE-DATA-OA' => 40,
        'CREDIT-MODULE-OA' => 60,
        'RAP-OA' => 70,
        'INTERACTION-OA' => 80,
        'CREDIT-REPORT-OA' => 90,
        'CONTRACT-PERFORMANCE-OA' => 100,
        'RESOURCE-RANDOM-OA' => 110,
        'RESOURCE-PUBLICATION-OA' => 120,
        'CREDIT-RECORD-OA' => 130,
        'MEMBER-SELF-DECLARATION-OA' => 140,
        'RESOURCE-PUBLICATION-QUALITY-ANALYSIS-OA' => 150
    );

    private $id;
    /**
     * @var int $category 分类
     */
    private $category;
    /**
     * @var array $result 统计结果
     */
    private $result;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->category = 0;
        $this->result = array();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->category);
        unset($this->result);
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

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setResult(array $result): void
    {
        $this->result = $result;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}

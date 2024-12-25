<?php
namespace Sdk\Monitor\FocusMonitor\Model;

class FocusMonitorReport
{
    /**
     * 行政处罚状态
     * NOT_EXCEEDING_THRESHOLD 未超过阈值
     * EXCEEDING_THRESHOLD 超过阈值
     */
    const PENALTY_WARNING_STATUS = array(
        'NOT_EXCEEDING_THRESHOLD' => 0,
        'EXCEEDING_THRESHOLD' => 1
    );

    const PENALTY_WARNING_STATUS_CN = array(
        self::PENALTY_WARNING_STATUS['NOT_EXCEEDING_THRESHOLD'] => '未超过阈值',
        self::PENALTY_WARNING_STATUS['EXCEEDING_THRESHOLD'] => '超过阈值'
    );
    
    /**
     * 严重失信状态
     * NOT_EXCEEDING_THRESHOLD 未超过阈值
     * EXCEEDING_THRESHOLD 超过阈值
     */
    const DISHONESTY_WARNING_STATUS = array(
        'NOT_EXCEEDING_THRESHOLD' => 0,
        'EXCEEDING_THRESHOLD' => 1
    );

    const DISHONESTY_WARNING_STATUS_CN = array(
        self::DISHONESTY_WARNING_STATUS['NOT_EXCEEDING_THRESHOLD'] => '未超过阈值',
        self::DISHONESTY_WARNING_STATUS['EXCEEDING_THRESHOLD'] => '超过阈值'
    );

    private $id;
    /**
     * @var int $dishonestyCount 严重失信数量
     */
    private $dishonestyCount;
    /**
     * @var int $penaltyCount 行政处罚数量
     */
    private $penaltyCount;
    /**
     * @var int $penaltyWarningStatus 行政处罚状态
     */
    private $penaltyWarningStatus;
    /**
     * @var int $dishonestyWarningStatus 严重失信状态
     */
    private $dishonestyWarningStatus;
    /**
     * @var FocusMonitor $focusMonitor 重点关注对象
     */
    private $focusMonitor;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->dishonestyCount = 0;
        $this->penaltyCount = 0;
        $this->penaltyWarningStatus = 0;
        $this->dishonestyWarningStatus = 0;
        $this->focusMonitor = new FocusMonitor();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->dishonestyCount);
        unset($this->penaltyCount);
        unset($this->penaltyWarningStatus);
        unset($this->dishonestyWarningStatus);
        unset($this->focusMonitor);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDishonestyCount(int $dishonestyCount): void
    {
        $this->dishonestyCount = $dishonestyCount;
    }

    public function getDishonestyCount(): int
    {
        return $this->dishonestyCount;
    }

    public function setPenaltyCount(int $penaltyCount): void
    {
        $this->penaltyCount = $penaltyCount;
    }

    public function getPenaltyCount(): int
    {
        return $this->penaltyCount;
    }

    public function setPenaltyWarningStatus(int $penaltyWarningStatus): void
    {
        $this->penaltyWarningStatus = $penaltyWarningStatus;
    }

    public function getPenaltyWarningStatus(): int
    {
        return $this->penaltyWarningStatus;
    }

    public function setDishonestyWarningStatus(int $dishonestyWarningStatus): void
    {
        $this->dishonestyWarningStatus = $dishonestyWarningStatus;
    }

    public function getDishonestyWarningStatus(): int
    {
        return $this->dishonestyWarningStatus;
    }
    
    public function setFocusMonitor(FocusMonitor $focusMonitor): void
    {
        $this->focusMonitor = $focusMonitor;
    }

    public function getFocusMonitor(): FocusMonitor
    {
        return $this->focusMonitor;
    }
}

<?php
namespace Sdk\Application\UploadDataTask\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

class UploadDataTaskRecord implements IObject
{
    use Object;
    
    /**
     * 错误编号
     * NULL 未定义
     * FORMAT_ERROR 数据格式错误
     * DATA_DUPLICATION 数据重复
     */
    const ERROR_NUMBER = array(
        'NULL' => 0,
        'FORMAT_ERROR' => 1,
        'DATA_DUPLICATION' => 2
    );

    const ERROR_NUMBER_CN = array(
        self::ERROR_NUMBER['NULL'] => '未定义',
        self::ERROR_NUMBER['FORMAT_ERROR'] => '数据格式错误',
        self::ERROR_NUMBER['DATA_DUPLICATION'] => '数据重复'
    );
 
    private $id;
    /**
     * @var int $index 失败记录在excel文件的索引号
     */
    private $index;
    /**
     * @var array $items 失败原始上传数据
     */
    private $items;
    /**
     * @var int $errorNumber 错误编号
     */
    private $errorNumber;
    /**
     * @var array $errorDescription 错误原因
     */
    private $errorDescription;
    /**
     * @var array $failReason 错误原因中文
     */
    private $failReason;
    /**
     * @var UploadDataTask $uploadDataTask 任务
     */
    private $uploadDataTask;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->index = 0;
        $this->items = array();
        $this->errorNumber = 0;
        $this->errorDescription = array();
        $this->failReason = array();
        $this->uploadDataTask = new UploadDataTask();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->index);
        unset($this->items);
        unset($this->errorNumber);
        unset($this->errorDescription);
        unset($this->failReason);
        unset($this->uploadDataTask);
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

    public function setErrorNumber(int $errorNumber): void
    {
        $this->errorNumber = $errorNumber;
    }

    public function getErrorNumber(): int
    {
        return $this->errorNumber;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setFailReason(array $failReason): void
    {
        $this->failReason = $failReason;
    }

    public function getFailReason(): array
    {
        return $this->failReason;
    }
    
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setErrorDescription(array $errorDescription): void
    {
        $this->errorDescription = $errorDescription;
    }

    public function getErrorDescription(): array
    {
        return $this->errorDescription;
    }

    public function setUploadDataTask(UploadDataTask $uploadDataTask): void
    {
        $this->uploadDataTask = $uploadDataTask;
    }

    public function getUploadDataTask(): UploadDataTask
    {
        return $this->uploadDataTask;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}

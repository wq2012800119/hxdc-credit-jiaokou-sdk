<?php
namespace Sdk\Dictionary\Category\Model;

use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

class Category implements IObject
{
    use Object;

    private $id;
    /**
     * @var string $name 名称
     */
    private $name;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}

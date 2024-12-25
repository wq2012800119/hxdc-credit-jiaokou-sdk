<?php
namespace Sdk\Template\Model;

use Sdk\Template\Repository\TemplateRepository;

class Template
{
    /**
     * 模板类型
     * COMMITMENT 4 信用承诺
     * CONTRACT_PERFORMANCE 6 合同履约
     */
    const CATEGORY = array(
        'COMMITMENT' => 4,
        'CONTRACT_PERFORMANCE' => 6
    );

    private $id;
    /**
     * @var string $name 文件名称
     */
    private $name;
    /**
     * @var string $path 文件地址
     */
    private $path;
    /**
     * @var int $category 模板类型
     */
    private $category;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->name = '';
        $this->path = '';
        $this->category = 0;
        $this->repository = new TemplateRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->name);
        unset($this->path);
        unset($this->category);
        unset($this->repository);
    }

    public function setId(int $id): void
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

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    protected function getRepository() : TemplateRepository
    {
        return $this->repository;
    }

    public function export() : bool
    {
        return $this->getRepository()->export($this);
    }
}

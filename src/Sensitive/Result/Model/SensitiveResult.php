<?php
namespace Sdk\Sensitive\Result\Model;

use Marmot\Core;
use Marmot\Common\Model\Object;
use Marmot\Common\Model\IObject;

use Sdk\Sensitive\Result\Repository\SensitiveResultRepository;

use Sdk\Article\Article\Model\Article;

class SensitiveResult implements IObject
{
    use Object;
    
    private $id;
    /**
     * @var array $titleContains 标题过滤结果
     */
    private $titleContains;
    /**
     * @var array $descriptionContains 描述过滤结果
     */
    private $descriptionContains;
    /**
     * @var array $contentContains 内容过滤结果
     */
    private $contentContains;
    /**
     * @var Article $article 新闻
     */
    private $article;
    
    private $repository;

    public function __construct(int $id = 0)
    {
        $this->id = !empty($id) ? $id : 0;
        $this->titleContains = array();
        $this->descriptionContains = array();
        $this->contentContains = array();
        $this->article = new Article();
        $this->status = 0;
        $this->createTime = 0;
        $this->updateTime = 0;
        $this->statusTime = 0;
        $this->repository = new SensitiveResultRepository();
    }

    public function __destruct()
    {
        unset($this->id);
        unset($this->titleContains);
        unset($this->descriptionContains);
        unset($this->contentContains);
        unset($this->article);
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

    public function setTitleContains(array $titleContains): void
    {
        $this->titleContains = $titleContains;
    }

    public function getTitleContains(): array
    {
        return $this->titleContains;
    }

    public function setDescriptionContains(array $descriptionContains): void
    {
        $this->descriptionContains = $descriptionContains;
    }

    public function getDescriptionContains(): array
    {
        return $this->descriptionContains;
    }

    public function setContentContains(array $contentContains): void
    {
        $this->contentContains = $contentContains;
    }

    public function getContentContains(): array
    {
        return $this->contentContains;
    }

    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
    
    protected function getRepository() : SensitiveResultRepository
    {
        return $this->repository;
    }
}

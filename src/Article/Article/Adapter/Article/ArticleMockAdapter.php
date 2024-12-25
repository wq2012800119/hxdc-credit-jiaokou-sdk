<?php
namespace Sdk\Article\Article\Adapter\Article;

use Sdk\Common\Adapter\Traits\TopAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Article\Article\Model\Article;
use Sdk\Sensitive\Result\Model\SensitiveResult;
use Sdk\Article\Article\Utils\MockObjectGenerate;

class ArticleMockAdapter implements IArticleAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, TopAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateArticle($id);
    }

    //单条新闻敏感词过滤
    public function process(Article $article) : SensitiveResult
    {
        return new SensitiveResult($article->getId());
    }
}

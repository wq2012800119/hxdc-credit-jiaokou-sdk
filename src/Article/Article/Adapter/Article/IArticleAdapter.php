<?php
namespace Sdk\Article\Article\Adapter\Article;

use Sdk\Common\Adapter\Interfaces\ITopAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

use Sdk\Article\Article\Model\Article;
use Sdk\Sensitive\Result\Model\SensitiveResult;

interface IArticleAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter, ITopAbleAdapter
{
    //单条新闻敏感词过滤
    public function process(Article $article) : SensitiveResult;
}

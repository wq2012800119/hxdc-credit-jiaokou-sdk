<?php
namespace Sdk\Article\Article\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\TopAbleRepositoryTrait;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Article\Adapter\Article\IArticleAdapter;
use Sdk\Article\Article\Adapter\Article\ArticleMockAdapter;
use Sdk\Article\Article\Adapter\Article\ArticleRestfulAdapter;

use Sdk\Sensitive\Result\Model\SensitiveResult;

class ArticleRepository extends CommonRepository implements IArticleAdapter
{
    use TopAbleRepositoryTrait, ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'ARTICLE_LIST';
    const FETCH_ONE_MODEL_UN = 'ARTICLE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ArticleRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ArticleMockAdapter()
        );
    }

    public function process(Article $article) : SensitiveResult
    {
        return $this->getAdapter()->process($article);
    }
}

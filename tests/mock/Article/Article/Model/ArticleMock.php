<?php
namespace Sdk\Article\Article\Model;

use Sdk\Article\Article\Repository\ArticleRepository;

class ArticleMock extends Article
{
    public function getRepositoryPublic() : ArticleRepository
    {
        return parent::getRepository();
    }
}

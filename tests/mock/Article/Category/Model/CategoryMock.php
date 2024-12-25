<?php
namespace Sdk\Article\Category\Model;

use Sdk\Article\Category\Repository\CategoryRepository;

class CategoryMock extends Category
{
    public function getRepositoryPublic() : CategoryRepository
    {
        return parent::getRepository();
    }
}

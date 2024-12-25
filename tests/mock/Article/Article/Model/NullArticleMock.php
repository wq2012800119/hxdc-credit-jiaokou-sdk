<?php
namespace Sdk\Article\Article\Model;

class NullArticleMock extends NullArticle
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

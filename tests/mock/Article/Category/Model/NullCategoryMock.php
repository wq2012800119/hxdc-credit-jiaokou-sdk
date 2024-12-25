<?php
namespace Sdk\Article\Category\Model;

class NullCategoryMock extends NullCategory
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

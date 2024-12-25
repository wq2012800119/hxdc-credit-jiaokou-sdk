<?php
namespace Sdk\Dictionary\Item\Model;

class NullItemMock extends NullItem
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

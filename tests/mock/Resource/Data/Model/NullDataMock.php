<?php
namespace Sdk\Resource\Data\Model;

class NullDataMock extends NullData
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

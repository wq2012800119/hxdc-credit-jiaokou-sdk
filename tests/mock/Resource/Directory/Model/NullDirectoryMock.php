<?php
namespace Sdk\Resource\Directory\Model;

class NullDirectoryMock extends NullDirectory
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

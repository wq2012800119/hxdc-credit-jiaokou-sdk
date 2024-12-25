<?php
namespace Sdk\Resource\UploadDataTask\Model;

class NullUploadDataTaskMock extends NullUploadDataTask
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

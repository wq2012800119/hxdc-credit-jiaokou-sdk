<?php
namespace Sdk\Resource\UploadDataTask\Model;

use Sdk\Resource\UploadDataTask\Repository\UploadDataTaskRepository;

class UploadDataTaskMock extends UploadDataTask
{
    public function getRepositoryPublic() : UploadDataTaskRepository
    {
        return parent::getRepository();
    }
}

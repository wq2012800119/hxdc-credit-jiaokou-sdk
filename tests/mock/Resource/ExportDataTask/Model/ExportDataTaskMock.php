<?php
namespace Sdk\Resource\ExportDataTask\Model;

use Sdk\Resource\ExportDataTask\Repository\ExportDataTaskRepository;

class ExportDataTaskMock extends ExportDataTask
{
    public function getRepositoryPublic() : ExportDataTaskRepository
    {
        return parent::getRepository();
    }
}

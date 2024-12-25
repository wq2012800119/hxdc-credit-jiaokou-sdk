<?php
namespace Sdk\Organization\Department\Model;

use Sdk\Organization\Department\Repository\DepartmentRepository;

class DepartmentMock extends Department
{
    public function getRepositoryPublic() : DepartmentRepository
    {
        return parent::getRepository();
    }
}

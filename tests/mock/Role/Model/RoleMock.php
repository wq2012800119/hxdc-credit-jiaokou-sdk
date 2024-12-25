<?php
namespace Sdk\Role\Model;

use Sdk\Role\Repository\RoleRepository;

class RoleMock extends Role
{
    public function getRepositoryPublic() : RoleRepository
    {
        return parent::getRepository();
    }
}

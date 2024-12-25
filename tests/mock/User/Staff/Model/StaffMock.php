<?php
namespace Sdk\User\Staff\Model;

use Sdk\User\Staff\Repository\StaffRepository;

class StaffMock extends Staff
{
    public function getRepositoryPublic() : StaffRepository
    {
        return parent::getRepository();
    }

    public function getStaffJwtAuthPublic() : StaffJwtAuth
    {
        return parent::getStaffJwtAuth();
    }
}

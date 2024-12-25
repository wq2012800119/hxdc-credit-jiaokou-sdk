<?php
namespace Sdk\User\Staff\Model;

use Sdk\User\Staff\Repository\StaffRepository;
use Sdk\User\Staff\Translator\StaffTranslator;

class StaffJwtAuthMock extends StaffJwtAuth
{
    public function getRepositoryPublic() : StaffRepository
    {
        return parent::getRepository();
    }

    public function getTranslatorPublic() : StaffTranslator
    {
        return parent::getTranslator();
    }

    public function generateJwtPublic(Staff $staff) : bool
    {
        return parent::generateJwt($staff);
    }

    public function fetchJwtPublic(array $payload) : string
    {
        return parent::fetchJwt($payload);
    }

    public function saveStaffToCachePublic(Staff $staff) : bool
    {
        return parent::saveStaffToCache($staff);
    }

    public function initStaffPublic(Staff $staff) : bool
    {
        return parent::initStaff($staff);
    }

    public function verifyJwtPublic(string $jwt) : bool
    {
        return parent::verifyJwt($jwt);
    }

    public function fetchStaffPublic() : Staff
    {
        return parent::fetchStaff();
    }
}

<?php
namespace Sdk\Organization\Organization\Model;

use Sdk\Organization\Organization\Repository\OrganizationRepository;

class OrganizationMock extends Organization
{
    public function getRepositoryPublic() : OrganizationRepository
    {
        return parent::getRepository();
    }
}

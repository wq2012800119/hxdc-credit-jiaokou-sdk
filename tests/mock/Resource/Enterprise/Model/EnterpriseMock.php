<?php
namespace Sdk\Resource\Enterprise\Model;

use Sdk\Resource\Enterprise\Repository\EnterpriseRepository;

class EnterpriseMock extends Enterprise
{
    public function getRepositoryPublic() : EnterpriseRepository
    {
        return parent::getRepository();
    }
}

<?php
namespace Sdk\Resource\NaturalPerson\Model;

use Sdk\Resource\NaturalPerson\Repository\NaturalPersonRepository;

class NaturalPersonMock extends NaturalPerson
{
    public function getRepositoryPublic() : NaturalPersonRepository
    {
        return parent::getRepository();
    }
}

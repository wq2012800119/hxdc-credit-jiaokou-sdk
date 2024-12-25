<?php
namespace Sdk\Resource\Data\Model;

use Sdk\Resource\Data\Repository\DataRepository;

class DataMock extends Data
{
    public function getRepositoryPublic() : DataRepository
    {
        return parent::getRepository();
    }
}

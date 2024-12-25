<?php
namespace Sdk\Resource\Directory\Model;

use Sdk\Resource\Directory\Repository\DirectoryRepository;

class DirectoryMock extends Directory
{
    public function getRepositoryPublic() : DirectoryRepository
    {
        return parent::getRepository();
    }
}

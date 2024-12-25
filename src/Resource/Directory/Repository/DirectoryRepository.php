<?php
namespace Sdk\Resource\Directory\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;
use Sdk\Common\Repository\Traits\ExamineAbleRepositoryTrait;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Adapter\Directory\IDirectoryAdapter;
use Sdk\Resource\Directory\Adapter\Directory\DirectoryMockAdapter;
use Sdk\Resource\Directory\Adapter\Directory\DirectoryRestfulAdapter;

class DirectoryRepository extends CommonRepository implements IDirectoryAdapter
{
    use ExamineAbleRepositoryTrait;

    const LIST_MODEL_UN = 'DIRECTORY_LIST';
    const FETCH_ONE_MODEL_UN = 'DIRECTORY_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new DirectoryRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new DirectoryMockAdapter()
        );
    }

    public function rollback(Directory $directory) : bool
    {
        return $this->getAdapter()->rollback($directory);
    }

    public function export(Directory $directory) : bool
    {
        return $this->getAdapter()->export($directory);
    }
}

<?php
namespace Sdk\Resource\Directory\Adapter\Directory;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Utils\MockObjectGenerate;

class DirectoryMockAdapter implements IDirectoryAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateDirectory($id);
    }

    public function rollback(Directory $directory) : bool
    {
        unset($directory);
        return true;
    }

    public function export(Directory $directory) : bool
    {
        unset($directory);
        return true;
    }
}

<?php
namespace Sdk\Resource\Directory\Adapter\Directory;

use Sdk\Resource\Directory\Model\Directory;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

interface IDirectoryAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
    public function rollback(Directory $directory) : bool;
    public function export(Directory $directory) : bool;
}

<?php
namespace Sdk\Resource\Directory\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class DirectoryPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RESOURCE_DIRECTORY']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $directoryColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY'];
        $directoryExamineColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY_EXAMINE'];

        return (isset($staffPurview[$directoryColumn]) || isset($staffPurview[$directoryExamineColumn]));
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
    
    public function enable() : bool
    {
        return $this->operation('enable');
    }

    public function disable() : bool
    {
        return $this->operation('disable');
    }

    public function rollback() : bool
    {
        return $this->operation('rollback');
    }
    
    public function approve() : bool
    {
        $directoryExamineColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY_EXAMINE'];

        return $this->operation('approve', $directoryExamineColumn);
    }

    public function reject() : bool
    {
        $directoryExamineColumn = IPurviewAble::COLUMN['RESOURCE_DIRECTORY_EXAMINE'];

        return $this->operation('reject', $directoryExamineColumn);
    }
}

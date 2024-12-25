<?php
namespace Sdk\Member\ResourceData\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class ResourceDataPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['MEMBER_RESOURCE_DATA']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $dataColumn = IPurviewAble::COLUMN['MEMBER_RESOURCE_DATA'];
        $dataExamineColumn = IPurviewAble::COLUMN['MEMBER_RESOURCE_DATA_EXAMINE'];

        return (isset($staffPurview[$dataColumn]) || isset($staffPurview[$dataExamineColumn]));
    }

    public function approve() : bool
    {
        return $this->operation('approve', IPurviewAble::COLUMN['MEMBER_RESOURCE_DATA_EXAMINE']);
    }

    public function reject() : bool
    {
        return $this->operation('reject', IPurviewAble::COLUMN['MEMBER_RESOURCE_DATA_EXAMINE']);
    }
}

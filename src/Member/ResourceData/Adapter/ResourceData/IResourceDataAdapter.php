<?php
namespace Sdk\Member\ResourceData\Adapter\ResourceData;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

use Sdk\Member\ResourceData\Model\ResourceData;

interface IResourceDataAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
    //撤销
    public function revoke(ResourceData $resourceData) : bool;
}

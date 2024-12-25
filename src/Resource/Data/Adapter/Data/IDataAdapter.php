<?php
namespace Sdk\Resource\Data\Adapter\Data;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

interface IDataAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
}

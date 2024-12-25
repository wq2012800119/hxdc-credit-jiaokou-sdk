<?php
namespace Sdk\Application\Commitment\Adapter\Promise;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

interface IPromiseAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
}

<?php
namespace Sdk\Member\Commitment\Adapter\Commitment;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

use Sdk\Member\Commitment\Model\Commitment;

interface ICommitmentAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
    //撤销
    public function revoke(Commitment $commitment) : bool;
}

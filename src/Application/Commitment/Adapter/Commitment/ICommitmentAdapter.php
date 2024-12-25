<?php
namespace Sdk\Application\Commitment\Adapter\Commitment;

use Sdk\Application\Commitment\Model\Commitment;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IExamineAbleAdapter;

interface ICommitmentAdapter extends IFetchAbleAdapter, IOperateAbleAdapter, IExamineAbleAdapter
{
    //监管中
    public function superviseDoing(Commitment $commitment) : bool;
    //完成监管
    public function superviseDone(Commitment $commitment) : bool;
}

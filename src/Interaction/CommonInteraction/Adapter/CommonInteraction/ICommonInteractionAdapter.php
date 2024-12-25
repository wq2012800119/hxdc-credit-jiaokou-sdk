<?php
namespace Sdk\Interaction\CommonInteraction\Adapter\CommonInteraction;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

use Sdk\Interaction\CommonInteraction\Model\CommonInteraction;

interface ICommonInteractionAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    //受理
    public function accept(CommonInteraction $commonInteraction) : bool;

    //撤销
    public function revoke(CommonInteraction $commonInteraction) : bool;

    //转交
    public function forward(CommonInteraction $commonInteraction) : bool;
}

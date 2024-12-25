<?php
namespace Sdk\Common\Adapter\Interfaces;

use Sdk\Common\Model\Interfaces\ITopAble;

interface ITopAbleAdapter
{
    public function top(ITopAble $topAbleObject) : bool;

    public function cancelTop(ITopAble $topAbleObject) : bool;
}

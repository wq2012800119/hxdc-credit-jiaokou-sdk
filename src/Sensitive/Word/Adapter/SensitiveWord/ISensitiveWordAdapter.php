<?php
namespace Sdk\Sensitive\Word\Adapter\SensitiveWord;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

use Sdk\Sensitive\Word\Model\SensitiveWord;

interface ISensitiveWordAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    public function batchProcess(SensitiveWord $sensitiveWord) : bool;
}

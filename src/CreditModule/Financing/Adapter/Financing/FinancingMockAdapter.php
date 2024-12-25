<?php
namespace Sdk\CreditModule\Financing\Adapter\Financing;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\Financing\Model\Financing;

class FinancingMockAdapter implements IFinancingAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Financing($id);
    }
}

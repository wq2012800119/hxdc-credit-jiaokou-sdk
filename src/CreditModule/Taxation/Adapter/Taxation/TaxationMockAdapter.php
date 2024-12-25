<?php
namespace Sdk\CreditModule\Taxation\Adapter\Taxation;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\Taxation\Model\Taxation;

class TaxationMockAdapter implements ITaxationAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Taxation($id);
    }
}

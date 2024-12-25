<?php
namespace Sdk\CreditModule\Collateral\Adapter\Collateral;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\Collateral\Model\Collateral;

class CollateralMockAdapter implements ICollateralAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Collateral($id);
    }
}

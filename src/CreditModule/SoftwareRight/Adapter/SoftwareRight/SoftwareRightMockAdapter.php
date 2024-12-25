<?php
namespace Sdk\CreditModule\SoftwareRight\Adapter\SoftwareRight;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\SoftwareRight\Model\SoftwareRight;

class SoftwareRightMockAdapter implements ISoftwareRightAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new SoftwareRight($id);
    }
}

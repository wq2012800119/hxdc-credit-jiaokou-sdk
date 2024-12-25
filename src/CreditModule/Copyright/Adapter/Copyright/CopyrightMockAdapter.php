<?php
namespace Sdk\CreditModule\Copyright\Adapter\Copyright;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\Copyright\Model\Copyright;

class CopyrightMockAdapter implements ICopyrightAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Copyright($id);
    }
}

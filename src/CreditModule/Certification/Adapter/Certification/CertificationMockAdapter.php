<?php
namespace Sdk\CreditModule\Certification\Adapter\Certification;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\Certification\Model\Certification;

class CertificationMockAdapter implements ICertificationAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Certification($id);
    }
}

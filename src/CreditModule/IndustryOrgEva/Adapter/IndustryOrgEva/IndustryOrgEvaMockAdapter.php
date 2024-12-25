<?php
namespace Sdk\CreditModule\IndustryOrgEva\Adapter\IndustryOrgEva;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\CreditModule\IndustryOrgEva\Model\IndustryOrgEva;

class IndustryOrgEvaMockAdapter implements IIndustryOrgEvaAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new IndustryOrgEva($id);
    }
}

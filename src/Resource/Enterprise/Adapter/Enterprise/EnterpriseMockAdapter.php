<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Resource\Enterprise\Model\Enterprise;
use Sdk\Resource\Enterprise\Utils\MockObjectGenerate;

class EnterpriseMockAdapter implements IEnterpriseAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateEnterprise($id);
    }

    public function authorize(Enterprise $enterprise) : bool
    {
        unset($enterprise);
        return true;
    }

    public function unAuthorize(Enterprise $enterprise) : bool
    {
        unset($enterprise);
        return true;
    }

    public function fetchEnterpriseInteractionCount(Enterprise $enterprise) : Enterprise
    {
        return $enterprise;
    }
}

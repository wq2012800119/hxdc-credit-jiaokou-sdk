<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;

use Sdk\Resource\Enterprise\Model\Enterprise;

interface IEnterpriseAdapter extends IFetchAbleAdapter
{
    public function authorize(Enterprise $enterprise) : bool;

    public function unAuthorize(Enterprise $enterprise) : bool;

    public function fetchEnterpriseInteractionCount(Enterprise $enterprise) : Enterprise;
}

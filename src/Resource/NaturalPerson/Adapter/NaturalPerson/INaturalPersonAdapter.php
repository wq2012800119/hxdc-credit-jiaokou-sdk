<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

interface INaturalPersonAdapter extends IFetchAbleAdapter
{
    public function authorize(NaturalPerson $naturalPerson) : bool;

    public function unAuthorize(NaturalPerson $naturalPerson) : bool;
}

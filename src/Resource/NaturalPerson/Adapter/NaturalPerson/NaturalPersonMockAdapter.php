<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;
use Sdk\Resource\NaturalPerson\Utils\MockObjectGenerate;

class NaturalPersonMockAdapter implements INaturalPersonAdapter
{
    use FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateNaturalPerson($id);
    }

    public function authorize(NaturalPerson $naturalPerson) : bool
    {
        unset($naturalPerson);
        return true;
    }

    public function unAuthorize(NaturalPerson $naturalPerson) : bool
    {
        unset($naturalPerson);
        return true;
    }
}

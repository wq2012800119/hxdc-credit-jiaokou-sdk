<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use Marmot\Interfaces\INull;

class NaturalPersonRestfulAdapterMock extends NaturalPersonRestfulAdapter
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getScenario() : array
    {
        return parent::getScenario();
    }

    public function getAlonePossessMapErrorsPublic() : array
    {
        return parent::getAlonePossessMapErrors();
    }
}

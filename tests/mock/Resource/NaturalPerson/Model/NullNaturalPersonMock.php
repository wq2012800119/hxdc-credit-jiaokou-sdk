<?php
namespace Sdk\Resource\NaturalPerson\Model;

class NullNaturalPersonMock extends NullNaturalPerson
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

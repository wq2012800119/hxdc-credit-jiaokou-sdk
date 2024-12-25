<?php
namespace Sdk\Organization\Organization\Model;

class NullOrganizationMock extends NullOrganization
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

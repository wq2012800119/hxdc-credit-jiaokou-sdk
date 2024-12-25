<?php
namespace Sdk\Resource\Enterprise\Model;

class NullEnterpriseMock extends NullEnterprise
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

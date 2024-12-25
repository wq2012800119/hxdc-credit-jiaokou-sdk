<?php
namespace Sdk\User\Member\Model;

class NullMemberMock extends NullMember
{
    public function resourceNotExistPublic() : bool
    {
        return parent::resourceNotExist();
    }
}

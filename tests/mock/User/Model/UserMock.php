<?php
namespace Sdk\User\Model;

use Sdk\Common\Repository\MockRepository;

class UserMock extends User
{
    protected function getRepository()
    {
        return new MockRepository();
    }
}

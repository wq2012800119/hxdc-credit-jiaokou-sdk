<?php
namespace Sdk\User\Staff\Cache;

class StaffJwtAuthCacheMock extends StaffJwtAuthCache
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

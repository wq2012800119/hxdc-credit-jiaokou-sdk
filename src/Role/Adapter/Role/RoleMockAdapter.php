<?php
namespace Sdk\Role\Adapter\Role;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Role\Utils\MockObjectGenerate;

class RoleMockAdapter implements IRoleAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateRole($id);
    }
}

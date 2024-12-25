<?php
namespace Sdk\Role\Purview\Model;

class PurviewFactoryMock extends PurviewFactory
{
    public function getPurviewPublic(string $resource) : IPurviewAble
    {
        return parent::getPurview($resource);
    }
}

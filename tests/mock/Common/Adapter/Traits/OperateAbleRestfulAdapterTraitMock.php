<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

class OperateAbleRestfulAdapterTraitMock
{
    use OperateAbleRestfulAdapterTrait;

    public function getResource() : string
    {
        return '';
    }

    public function insertTranslatorKeys() : array
    {
        return array();
    }

    public function updateTranslatorKeys() : array
    {
        return array();
    }

    public function insertPublic(IOperateAble $operateAbleObject)
    {
        return $this->insert($operateAbleObject);
    }

    public function updatePublic(IOperateAble $operateAbleObject)
    {
        return $this->update($operateAbleObject);
    }

    public function enablePublic(IOperateAble $operateAbleObject)
    {
        return $this->enable($operateAbleObject);
    }

    public function disablePublic(IOperateAble $operateAbleObject)
    {
        return $this->disable($operateAbleObject);
    }
}

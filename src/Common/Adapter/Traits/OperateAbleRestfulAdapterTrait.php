<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\IOperateAble;

trait OperateAbleRestfulAdapterTrait
{
    abstract protected function getResource() : string;
    abstract protected function insertTranslatorKeys() : array;
    abstract protected function updateTranslatorKeys() : array;

    public function insert(IOperateAble $operateAbleObject) : bool
    {
        $keys = $this->insertTranslatorKeys();
        $data = $this->getTranslator()->objectToArray($operateAbleObject, $keys);
       
        $this->post(
            $this->getResource(),
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($operateAbleObject);
            return true;
        }

        return false;
    }

    public function update(IOperateAble $operateAbleObject) : bool
    {
        $keys = $this->updateTranslatorKeys();
        $data = $this->getTranslator()->objectToArray($operateAbleObject, $keys);

        $this->patch(
            $this->getResource().'/'.$operateAbleObject->getId(),
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($operateAbleObject);
            return true;
        }

        return false;
    }

    public function enable(IOperateAble $operateAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$operateAbleObject->getId().'/enable'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($operateAbleObject);
            return true;
        }

        return false;
    }

    public function disable(IOperateAble $operateAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$operateAbleObject->getId().'/disable'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($operateAbleObject);
            return true;
        }

        return false;
    }
}

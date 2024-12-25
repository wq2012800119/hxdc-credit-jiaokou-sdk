<?php
namespace Sdk\Common\Adapter\Traits;

use Sdk\Common\Model\Interfaces\ITopAble;

trait TopAbleRestfulAdapterTrait
{
    abstract protected function getResource() : string;

    public function top(ITopAble $topAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$topAbleObject->getId().'/top'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($topAbleObject);
            return true;
        }

        return false;
    }

    public function cancelTop(ITopAble $topAbleObject) : bool
    {
        $this->patch(
            $this->getResource().'/'.$topAbleObject->getId().'/cancelTop'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($topAbleObject);
            return true;
        }

        return false;
    }
}

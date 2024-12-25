<?php
namespace Sdk\Common\Adapter;

use Marmot\Interfaces\INull;

use Sdk\Common\Model\NullMockObject;
use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

class MockRestfulAdapter implements IFetchAbleAdapter, IOperateAbleAdapter
{
    use FetchAbleRestfulAdapterTrait, OperateAbleRestfulAdapterTrait;

    protected function getResource() : string
    {
        return '';
    }

    protected function getNullObject() : INull
    {
        return NullMockObject::getInstance();
    }

    protected function insertTranslatorKeys() : array
    {
        return array();
    }
    
    protected function updateTranslatorKeys() : array
    {
        return array();
    }
    
    protected function enableTranslatorKeys() : array
    {
        return array();
    }
    
    protected function disableTranslatorKeys() : array
    {
        return array();
    }

    public function scenario($scenario) : void
    {
        unset($scenario);
    }
}

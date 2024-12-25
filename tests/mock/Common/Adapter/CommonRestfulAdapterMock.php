<?php
namespace Sdk\Common\Adapter;

use Marmot\Interfaces\IRestfulTranslator;

use Sdk\Common\Translator\MockRestfulTranslatorAdapter;

class CommonRestfulAdapterMock extends CommonRestfulAdapter
{
    public function __construct()
    {
        parent::__construct(new MockRestfulTranslatorAdapter, 'tests');
    }

    public function getTranslatorPublic() : IRestfulTranslator
    {
        return parent::getTranslator();
    }

    public function getResourcePublic() : string
    {
        return parent::getResource();
    }
}

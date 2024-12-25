<?php
namespace Sdk\Resource\Enterprise\Translator;

use Marmot\Interfaces\INull;
use Sdk\Resource\Data\Translator\DataTranslator;

class EnterpriseTranslatorMock extends EnterpriseTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getDataTranslatorPublic() : DataTranslator
    {
        return parent::getDataTranslator();
    }
}

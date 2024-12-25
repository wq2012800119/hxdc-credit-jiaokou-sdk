<?php
namespace Sdk\Resource\Enterprise\Translator;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;

class EnterpriseRestfulTranslatorMock extends EnterpriseRestfulTranslator
{
    public function getDataRestfulTranslatorPublic() : DataRestfulTranslator
    {
        return parent::getDataRestfulTranslator();
    }
}

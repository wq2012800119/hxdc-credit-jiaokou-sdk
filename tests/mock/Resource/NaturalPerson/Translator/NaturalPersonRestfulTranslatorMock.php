<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use Sdk\Resource\Data\Translator\DataRestfulTranslator;

class NaturalPersonRestfulTranslatorMock extends NaturalPersonRestfulTranslator
{
    public function getDataRestfulTranslatorPublic() : DataRestfulTranslator
    {
        return parent::getDataRestfulTranslator();
    }
}

<?php
namespace Sdk\Resource\NaturalPerson\Translator;

use Marmot\Interfaces\INull;
use Sdk\Resource\Data\Translator\DataTranslator;

class NaturalPersonTranslatorMock extends NaturalPersonTranslator
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

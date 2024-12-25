<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\INull;

class TemplateTranslatorMock extends TemplateTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}

<?php
namespace Sdk\Log\ApplicationLog\Translator;

use Marmot\Interfaces\INull;

class ApplicationLogTranslatorMock extends ApplicationLogTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}

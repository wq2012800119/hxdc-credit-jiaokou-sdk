<?php
namespace Sdk\Organization\Organization\Translator;

use Marmot\Interfaces\INull;

use Sdk\Dictionary\Item\Translator\ItemTranslator;

class OrganizationTranslatorMock extends OrganizationTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getItemTranslatorPublic() : ItemTranslator
    {
        return parent::getItemTranslator();
    }
}

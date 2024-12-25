<?php
namespace Sdk\Organization\Organization\Translator;

use Sdk\Dictionary\Item\Translator\ItemRestfulTranslator;

class OrganizationRestfulTranslatorMock extends OrganizationRestfulTranslator
{
    public function getItemRestfulTranslatorPublic() : ItemRestfulTranslator
    {
        return parent::getItemRestfulTranslator();
    }
}

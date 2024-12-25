<?php
namespace Sdk\Dictionary\Item\Translator;

use Sdk\Dictionary\Category\Translator\CategoryRestfulTranslator;

class ItemRestfulTranslatorMock extends ItemRestfulTranslator
{
    public function getCategoryRestfulTranslatorPublic() : CategoryRestfulTranslator
    {
        return parent::getCategoryRestfulTranslator();
    }
}

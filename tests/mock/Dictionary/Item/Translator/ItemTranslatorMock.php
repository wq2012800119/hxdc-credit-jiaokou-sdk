<?php
namespace Sdk\Dictionary\Item\Translator;

use Marmot\Interfaces\INull;

use Sdk\Dictionary\Category\Translator\CategoryTranslator;

class ItemTranslatorMock extends ItemTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getCategoryTranslatorPublic() : CategoryTranslator
    {
        return parent::getCategoryTranslator();
    }
}

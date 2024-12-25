<?php
namespace Sdk\Dictionary\Category\Translator;

use Marmot\Interfaces\INull;

class CategoryTranslatorMock extends CategoryTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}

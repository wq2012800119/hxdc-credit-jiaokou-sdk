<?php
namespace Sdk\Article\Category\Translator;

use Marmot\Interfaces\INull;

class CategoryTranslatorMock extends CategoryTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function diyContentFormatConversionPublic(array $diyContent) : array
    {
        return parent::diyContentFormatConversion($diyContent);
    }
}

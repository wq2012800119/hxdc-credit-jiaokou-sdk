<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use Marmot\Interfaces\INull;

class HelpPageConfigTranslatorMock extends HelpPageConfigTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function diyContentFormatConversionPublic(array $diyContent, int $style) : array
    {
        return parent::diyContentFormatConversion($diyContent, $style);
    }
}

<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use Marmot\Interfaces\INull;

class HomePageConfigTranslatorMock extends HomePageConfigTranslator
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

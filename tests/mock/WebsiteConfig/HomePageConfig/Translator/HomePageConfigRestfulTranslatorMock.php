<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

class HomePageConfigRestfulTranslatorMock extends HomePageConfigRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }
}

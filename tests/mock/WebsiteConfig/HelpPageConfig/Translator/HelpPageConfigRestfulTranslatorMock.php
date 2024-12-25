<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

class HelpPageConfigRestfulTranslatorMock extends HelpPageConfigRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }
}

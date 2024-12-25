<?php
namespace Sdk\Article\Category\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

class CategoryRestfulTranslatorMock extends CategoryRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }
}

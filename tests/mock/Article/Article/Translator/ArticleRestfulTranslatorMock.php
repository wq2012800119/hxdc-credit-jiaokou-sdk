<?php
namespace Sdk\Article\Article\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Article\Category\Translator\CategoryRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class ArticleRestfulTranslatorMock extends ArticleRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }

    public function getCategoryRestfulTranslatorPublic() : CategoryRestfulTranslator
    {
        return parent::getCategoryRestfulTranslator();
    }

    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }
}

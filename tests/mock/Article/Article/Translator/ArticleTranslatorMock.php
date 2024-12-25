<?php
namespace Sdk\Article\Article\Translator;

use Marmot\Interfaces\INull;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Article\Category\Translator\CategoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ArticleTranslatorMock extends ArticleTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getStaffTranslatorPublic() : StaffTranslator
    {
        return parent::getStaffTranslator();
    }

    public function getCategoryTranslatorPublic() : CategoryTranslator
    {
        return parent::getCategoryTranslator();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }
}

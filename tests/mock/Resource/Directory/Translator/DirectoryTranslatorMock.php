<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\INull;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DirectoryTranslatorMock extends DirectoryTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getStaffTranslatorPublic() : StaffTranslator
    {
        return parent::getStaffTranslator();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }

    public function getTemplateTranslatorPublic() : TemplateTranslator
    {
        return parent::getTemplateTranslator();
    }
}

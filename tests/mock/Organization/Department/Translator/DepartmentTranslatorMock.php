<?php
namespace Sdk\Organization\Department\Translator;

use Marmot\Interfaces\INull;

use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DepartmentTranslatorMock extends DepartmentTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }
}

<?php
namespace Sdk\Organization\Department\Translator;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class DepartmentRestfulTranslatorMock extends DepartmentRestfulTranslator
{
    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }
}

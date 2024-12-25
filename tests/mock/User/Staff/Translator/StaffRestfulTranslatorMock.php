<?php
namespace Sdk\User\Staff\Translator;

use Sdk\Role\Translator\RoleRestfulTranslator;
use Sdk\Organization\Department\Translator\DepartmentRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class StaffRestfulTranslatorMock extends StaffRestfulTranslator
{
    public function getRoleRestfulTranslatorPublic() : RoleRestfulTranslator
    {
        return parent::getRoleRestfulTranslator();
    }

    public function getDepartmentRestfulTranslatorPublic() : DepartmentRestfulTranslator
    {
        return parent::getDepartmentRestfulTranslator();
    }

    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }
}

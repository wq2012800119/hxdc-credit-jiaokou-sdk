<?php
namespace Sdk\User\Staff\Translator;

use Marmot\Interfaces\INull;

use Sdk\Role\Translator\RoleTranslator;
use Sdk\Organization\Department\Translator\DepartmentTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class StaffTranslatorMock extends StaffTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getRoleTranslatorPublic() : RoleTranslator
    {
        return parent::getRoleTranslator();
    }

    public function getDepartmentTranslatorPublic() : DepartmentTranslator
    {
        return parent::getDepartmentTranslator();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }

    public function purviewFormatConversionToArrayPublic(array $purview) : array
    {
        return parent::purviewFormatConversionToArray($purview);
    }

    public function purviewFormatConversionToObjectPublic(array $purview) : array
    {
        return parent::purviewFormatConversionToObject($purview);
    }
}

<?php
namespace Sdk\Role\Translator;

use Marmot\Interfaces\INull;

class RoleTranslatorMock extends RoleTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function purviewFormatConversionToObjectPublic(array $purview) : array
    {
        return parent::purviewFormatConversionToObject($purview);
    }

    public function purviewFormatConversionToArrayPublic(array $purview) : array
    {
        return parent::purviewFormatConversionToArray($purview);
    }
}

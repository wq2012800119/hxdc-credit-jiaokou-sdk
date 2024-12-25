<?php
namespace Sdk\Resource\ExportDataTask\Translator;

use Marmot\Interfaces\INull;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Resource\Directory\Translator\DirectoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ExportDataTaskTranslatorMock extends ExportDataTaskTranslator
{
    public function getStaffTranslatorPublic() : StaffTranslator
    {
        return parent::getStaffTranslator();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }

    public function getDirectoryTranslatorPublic() : DirectoryTranslator
    {
        return parent::getDirectoryTranslator();
    }

    public function getSnapshotTranslatorPublic() : SnapshotTranslator
    {
        return parent::getSnapshotTranslator();
    }

    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}

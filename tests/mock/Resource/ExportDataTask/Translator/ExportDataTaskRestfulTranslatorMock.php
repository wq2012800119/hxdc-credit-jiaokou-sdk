<?php
namespace Sdk\Resource\ExportDataTask\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class ExportDataTaskRestfulTranslatorMock extends ExportDataTaskRestfulTranslator
{
    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }

    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }

    public function getSnapshotRestfulTranslatorPublic() : SnapshotRestfulTranslator
    {
        return parent::getSnapshotRestfulTranslator();
    }

    public function getDirectoryRestfulTranslatorPublic() : DirectoryRestfulTranslator
    {
        return parent::getDirectoryRestfulTranslator();
    }
}

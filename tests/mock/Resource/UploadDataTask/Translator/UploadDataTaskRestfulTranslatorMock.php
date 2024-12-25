<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class UploadDataTaskRestfulTranslatorMock extends UploadDataTaskRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }

    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }

    public function getDirectoryRestfulTranslatorPublic() : DirectoryRestfulTranslator
    {
        return parent::getDirectoryRestfulTranslator();
    }

    public function getSnapshotRestfulTranslatorPublic() : SnapshotRestfulTranslator
    {
        return parent::getSnapshotRestfulTranslator();
    }
}

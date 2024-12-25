<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use Marmot\Interfaces\INull;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Resource\Directory\Translator\DirectoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class UploadDataTaskTranslatorMock extends UploadDataTaskTranslator
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

    public function getSnapshotTranslatorPublic() : SnapshotTranslator
    {
        return parent::getSnapshotTranslator();
    }

    public function getDirectoryTranslatorPublic() : DirectoryTranslator
    {
        return parent::getDirectoryTranslator();
    }

    public function taskStatusFormatConversionPublic($uploadDataTask) : array
    {
        return parent::taskStatusFormatConversion($uploadDataTask);
    }
}

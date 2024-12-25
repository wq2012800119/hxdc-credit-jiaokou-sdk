<?php
namespace Sdk\Resource\Data\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class DataRestfulTranslatorMock extends DataRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }

    public function getSnapshotRestfulTranslatorPublic() : SnapshotRestfulTranslator
    {
        return parent::getSnapshotRestfulTranslator();
    }

    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }
}

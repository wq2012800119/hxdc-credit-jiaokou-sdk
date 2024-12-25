<?php
namespace Sdk\Resource\Data\Translator;

use Marmot\Interfaces\INull;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DataTranslatorMock extends DataTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getStaffTranslatorPublic() : StaffTranslator
    {
        return parent::getStaffTranslator();
    }

    public function getSnapshotTranslatorPublic() : SnapshotTranslator
    {
        return parent::getSnapshotTranslator();
    }

    public function getOrganizationTranslatorPublic() : OrganizationTranslator
    {
        return parent::getOrganizationTranslator();
    }
}

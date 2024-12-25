<?php
namespace Sdk\Resource\Directory\Translator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

class DirectoryRestfulTranslatorMock extends DirectoryRestfulTranslator
{
    public function getStaffRestfulTranslatorPublic() : StaffRestfulTranslator
    {
        return parent::getStaffRestfulTranslator();
    }

    public function getOrganizationRestfulTranslatorPublic() : OrganizationRestfulTranslator
    {
        return parent::getOrganizationRestfulTranslator();
    }

    public function getTemplateRestfulTranslatorPublic() : TemplateRestfulTranslator
    {
        return parent::getTemplateRestfulTranslator();
    }

    public function itemsFormatConversionPublic(array $items) : array
    {
        return parent::itemsFormatConversion($items);
    }

    public function subjectCategoryMergePublic(array $subjectCategoryArray) : int
    {
        return parent::subjectCategoryMerge($subjectCategoryArray);
    }

    public function subjectCategorySplitPublic(int $subjectCategory) : array
    {
        return parent::subjectCategorySplit($subjectCategory);
    }
}

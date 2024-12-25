<?php
namespace Sdk\Article\Category\WidgetRule;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class CategoryWidgetRuleMock extends CategoryWidgetRule
{
    public function getCommonWidgetRulePublic() : CommonWidgetRule
    {
        return parent::getCommonWidgetRule();
    }

    public function diyContentTypeFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentTypeFormatValidate($diyContent);
    }

    public function diyContentKeysFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentKeysFormatValidate($diyContent);
    }

    public function diyContentSlidesPictureDisplayStatusValidatePublic($diyContent) : bool
    {
        return parent::diyContentSlidesPictureDisplayStatusValidate($diyContent);
    }

    public function diyContentRightToolbarDisplayStatusValidatePublic($diyContent) : bool
    {
        return parent::diyContentRightToolbarDisplayStatusValidate($diyContent);
    }

    public function diyContentChildrenCategoriesValidatePublic($diyContent, $style) : bool
    {
        return parent::diyContentChildrenCategoriesValidate($diyContent, $style);
    }

    public function diyContentChildrenCategoriesTypeFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentChildrenCategoriesTypeFormatValidate($diyContent);
    }

    public function diyContentChildrenCategoriesUniqueValidatePublic($diyContent) : bool
    {
        return parent::diyContentChildrenCategoriesUniqueValidate($diyContent);
    }

    public function diyContentChildrenCategoriesFormatValidatePublic($diyContent, $style) : bool
    {
        return parent::diyContentChildrenCategoriesFormatValidate($diyContent, $style);
    }
}

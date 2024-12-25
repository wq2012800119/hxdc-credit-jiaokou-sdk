<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\WidgetRule;

use Sdk\Common\WidgetRule\CommonWidgetRule;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class HelpPageConfigWidgetRuleMock extends HelpPageConfigWidgetRule
{
    public function getCommonWidgetRulePublic() : CommonWidgetRule
    {
        return parent::getCommonWidgetRule();
    }

    public function diyContentTypeFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentTypeFormatValidate($diyContent);
    }

    public function diyContentFormatValidatePublic($diyContent, $style) : bool
    {
        return parent::diyContentFormatValidate($diyContent, $style);
    }

    public function diyContentStyleOneFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleOneFormatValidate($diyContent);
    }

    public function diyContentStyleOneCountFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleOneCountFormatValidate($diyContent);
    }

    public function diyContentStyleOneContentFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleOneContentFormatValidate($diyContent);
    }

    public function diyContentStyleTwoFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleTwoFormatValidate($diyContent);
    }

    public function diyContentStyleTwoCountFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleTwoCountFormatValidate($diyContent);
    }

    public function diyContentStyleTwoContentFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleTwoContentFormatValidate($diyContent);
    }

    public function diyContentStyleTwoContentItemsFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleTwoContentItemsFormatValidate($diyContent);
    }

    public function diyContentStyleThreeFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleThreeFormatValidate($diyContent);
    }

    public function diyContentStyleThreeCountFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleThreeCountFormatValidate($diyContent);
    }

    public function diyContentStyleThreeContentFormatValidatePublic($diyContent) : bool
    {
        return parent::diyContentStyleThreeContentFormatValidate($diyContent);
    }

    public function linkPublic($link) : bool
    {
        return parent::link($link);
    }
}

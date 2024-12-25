<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\WidgetRule;

use Marmot\Core;
use Sdk\Common\WidgetRule\CommonWidgetRule;

use Respect\Validation\Validator as V;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class HelpPageConfigWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 20;
    //验证标题长度：1-20个字符
    public function title($title) : bool
    {
        if (!V::stringType()->length(self::TITLE_MIN_LENGTH, self::TITLE_MAX_LENGTH)->validate($title)) {
            Core::setLastError(TITLE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function style($style) : bool
    {
        if (!V::numeric()->positive()->validate($style) || !in_array($style, HelpPageConfig::STYLE)) {
            Core::setLastError(HELP_PAGE_CONFIG_STYLE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证自定义内容格式
     * 1. 验证是否为数组格式
     * 2. 风格一:  验证数组不能超过10个,数组中包含: type, value, 且每个数组中的value不能超过2000位字符, type必须为picture或text
     * 3. 风格二: 验证数组不能超过50个, 数组中包含: name, items, status, name不能超过20位字符, items为数组且不能超过100个, link不能超过200位字符
     * 4. 风格三: 数组不能超过50个, 数组中包含: name, link, status, name不能超过20位字符, link不能超过200位字符
     */
    public function diyContent($diyContent, $style) : bool
    {
        return $this->diyContentTypeFormatValidate($diyContent)
            && $this->diyContentFormatValidate($diyContent, $style);
    }

    //1. 验证是否为数组格式
    protected function diyContentTypeFormatValidate($diyContent) : bool
    {
        if (!V::arrayType()->validate($diyContent) || empty($diyContent)) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function diyContentFormatValidate($diyContent, $style) : bool
    {
        if ($style == HelpPageConfig::STYLE['STYLE_ONE']) {
            return $this->diyContentStyleOneFormatValidate($diyContent);
        }

        if ($style == HelpPageConfig::STYLE['STYLE_TWO']) {
            return $this->diyContentStyleTwoFormatValidate($diyContent);
        }

        if ($style == HelpPageConfig::STYLE['STYLE_THREE']) {
            return $this->diyContentStyleThreeFormatValidate($diyContent);
        }

        return false;
    }

    //风格一:  验证数组不能超过10个,数组中包含: type, value, 且每个数组中的value不能超过2000位字符, type必须为picture或text
    protected function diyContentStyleOneFormatValidate($diyContent) : bool
    {
        return $this->diyContentStyleOneCountFormatValidate($diyContent)
            && $this->diyContentStyleOneContentFormatValidate($diyContent);
    }

    const DIY_CONTENT_STYLE_ONE_MAX_COUNT = 10;
    protected function diyContentStyleOneCountFormatValidate($diyContent) : bool
    {
        if (count($diyContent) > self::DIY_CONTENT_STYLE_ONE_MAX_COUNT) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const DIY_CONTENT_STYLE_ONE_TYPE = array('picture', 'text');
    protected function diyContentStyleOneContentFormatValidate($diyContent) : bool
    {
        foreach ($diyContent as $value) {
            if (!isset($value['type']) || !isset($value['value'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!in_array($value['type'], self::DIY_CONTENT_STYLE_ONE_TYPE)) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }
            
            if (!$this->getCommonWidgetRule()->content($value['value'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    //风格二: 验证数组不能超过50个, 数组中包含: name, items, status, name不能超过20位字符, items为数组且不能超过100个, link不能超过200位字符
    protected function diyContentStyleTwoFormatValidate($diyContent) : bool
    {
        return $this->diyContentStyleTwoCountFormatValidate($diyContent)
            && $this->diyContentStyleTwoContentFormatValidate($diyContent);
    }

    const DIY_CONTENT_STYLE_TWO_MAX_COUNT = 50;
    protected function diyContentStyleTwoCountFormatValidate($diyContent) : bool
    {
        if (count($diyContent) > self::DIY_CONTENT_STYLE_TWO_MAX_COUNT) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function diyContentStyleTwoContentFormatValidate($diyContent) : bool
    {
        foreach ($diyContent as $value) {
            if (!isset($value['name']) || !isset($value['items']) || !isset($value['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->name($value['name'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->status($value['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->diyContentStyleTwoContentItemsFormatValidate($value['items'])) {
                return false;
            }
        }

        return true;
    }

    const DIY_CONTENT_STYLE_TWO_ITEMS_MAX_COUNT = 100;
    protected function diyContentStyleTwoContentItemsFormatValidate($items)
    {
        if (count($items) > self::DIY_CONTENT_STYLE_TWO_ITEMS_MAX_COUNT) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        foreach ($items as $item) {
            if (!isset($item['name']) || !isset($item['link']) || !isset($item['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->name($item['name'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->status($item['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->link($item['link'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    //风格三: 数组不能超过50个, 数组中包含: name, link, status, name不能超过20位字符, link不能超过200位字符
    protected function diyContentStyleThreeFormatValidate($diyContent) : bool
    {
        return $this->diyContentStyleThreeCountFormatValidate($diyContent)
            && $this->diyContentStyleThreeContentFormatValidate($diyContent);
    }

    const DIY_CONTENT_STYLE_THREE_MAX_COUNT = 50;
    protected function diyContentStyleThreeCountFormatValidate($diyContent) : bool
    {
        if (count($diyContent) > self::DIY_CONTENT_STYLE_THREE_MAX_COUNT) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    protected function diyContentStyleThreeContentFormatValidate($diyContent) : bool
    {
        foreach ($diyContent as $value) {
            if (!isset($value['name']) || !isset($value['link']) || !isset($value['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->name($value['name'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->status($value['status'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->link($value['link'])) {
                Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    const LINK_MIN_LENGTH = 1;
    const LINK_MAX_LENGTH = 200;
    //验证名称长度：1-20个字符
    protected function link($link) : bool
    {
        if (!V::stringType()->length(self::LINK_MIN_LENGTH, self::LINK_MAX_LENGTH)->validate($link)) {
            Core::setLastError(HELP_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

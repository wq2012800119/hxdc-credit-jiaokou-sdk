<?php
namespace Sdk\WebsiteConfig\HomePageConfig\WidgetRule;

use Marmot\Core;
use Sdk\Common\WidgetRule\CommonWidgetRule;

use Respect\Validation\Validator as V;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class HomePageConfigWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const DIY_CONTENT_REQUIRED_KEYS_NAME = array(
        'headerBarRight', 'logo', 'theme', 'headerBackGround', 'headerSearch', 'mainNav', 'topFloatingWindow',
        'searchNav', 'articleContent', 'topicColumn', 'statistics', 'relevantSlides', 'relatedLinks',
        'partyAndGovernmentOrgans', 'governmentWebsiteErrorCorrection', 'footerOne', 'footerTwo', 'footerThree',
        'rightNav', 'websiteStyle'
    );

    const DIY_CONTENT_TYPE = array(
        'LINK' => 0, //链接-默认
        'TEXT' => 1, //文本
        'PICTURE' => 2, //图片
        'CODE' => 3, //代码
    );
    
    const DIY_CONTENT_CODE_TYPE = array(
        'DEFAULT' => 0, //无-默认
        'ACCESSIBLE_READING' => 1, //无障碍阅读
        'SWITCH_TO_TRADITIONAL' => 2, //切換到繁體
    );
    
    const DIY_CONTENT_DISPLAY_POSITION = array(
        'LEFT' => 0, //左侧-默认
        'RIGHT' => 1, //右侧
        'BOTTON' => 2, //底部
    );

    const DIY_CONTENT_VALIDATE_METHOD = array(
        'headerBarLeft' => 'headerBarLeftValidate',
        'headerBarRight' => 'headerBarRightValidate',
        'logo' => 'logoValidate',
        'theme' => 'themeValidate',
        'headerBackGround' => 'headerBackGroundValidate',
        'headerSearch' => 'headerSearchValidate',
        'mainNav' => 'mainNavValidate',
        'topFloatingWindow' => 'topFloatingWindowValidate',
        'searchNav' => 'searchNavValidate',
        'articleContent' => 'articleContentValidate',
        'topicColumn' => 'topicColumnValidate',
        'statistics' => 'statisticsValidate',
        'relevantSlides' => 'relevantSlidesValidate',
        'relatedLinks' => 'relatedLinksValidate',
        'partyAndGovernmentOrgans' => 'partyAndGovernmentOrgansValidate',
        'governmentWebsiteErrorCorrection' => 'governmentWebsiteErrorCorrectionValidate',
        'footerOne' => 'footerOneValidate',
        'footerTwo' => 'footerTwoValidate',
        'footerThree' => 'footerThreeValidate',
        'middlePopBox' => 'middlePopBoxValidate',
        'bayWindow' => 'bayWindowValidate',
        'rightNav' => 'rightNavValidate',
        'leftFloatingWindow' => 'leftFloatingWindowValidate',
        'websiteStyle' => 'websiteStyleValidate',
        'silhouette' => 'silhouetteValidate'
    );

    /** 验证自定义内容格式
     * 1. 验证是否为数组格式
     * 2. 验证数组中必填项健值是否存在
     * 3. 验证每个字段值格式是否正确
     */
    public function diyContent($diyContent) : bool
    {
        return $this->diyContentTypeFormatValidate($diyContent)
            && $this->diyContentFormatRequiredKeysValidate($diyContent)
            && $this->diyContentFormatValidate($diyContent);
    }

    //1. 验证是否为数组格式
    protected function diyContentTypeFormatValidate($diyContent) : bool
    {
        if (!V::arrayType()->validate($diyContent) || empty($diyContent)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //验证数组中必填项健值是否存在
    protected function diyContentFormatRequiredKeysValidate($diyContent) : bool
    {
        $requiredKeysName = self::DIY_CONTENT_REQUIRED_KEYS_NAME;
        $diyContentKeysName = array_keys($diyContent);

        foreach ($requiredKeysName as $keyName) {
            if (!in_array($keyName, $diyContentKeysName)) {
                Core::setLastError(
                    HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'diyContentRequiredKeys')
                );
                return false;
            }
        }

        return true;
    }
    
    //验证每个字段值格式是否正确
    protected function diyContentFormatValidate($diyContent) : bool
    {
        foreach ($diyContent as $key => $value) {
            $validateMethod = isset(self::DIY_CONTENT_VALIDATE_METHOD[$key]) ?
                                self::DIY_CONTENT_VALIDATE_METHOD[$key] :
                                '';
            if (!method_exists($this, $validateMethod)) {
                Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentKey'));
                return false;
            }

            if (!$this->$validateMethod($value)) {
                return false;
            }
        }

        return true;
    }

    //headerBarLeft
    const HEADER_BAR_LEFT_MAX_COUNT = 5;
    protected function headerBarLeftValidate($content) : bool
    {
        if (count($content) > self::HEADER_BAR_LEFT_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerBarLeftCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->headerBarLeftKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentTypeValidate($value['type'])
                && $this->diyContentLinkValidate($value['link'], $value['type'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function headerBarLeftKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['type']) ||
            !isset($content['link']) || !isset($content['status'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerBarLeftRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //headerBarRight
    const HEADER_BAR_RIGHT_MAX_COUNT = 5;
    protected function headerBarRightValidate($content) : bool
    {
        if (count($content) > self::HEADER_BAR_RIGHT_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerBarRightCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->headerBarRightKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'], $value['type'])
                && $this->diyContentTypeValidate($value['type'])
                && $this->diyContentStatusValidate($value['status'])
                && $this->diyContentCodeTypeValidate($value['codeType']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function headerBarRightKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['type']) ||
            !isset($content['link']) || !isset($content['status']) || !isset($content['codeType'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerBarRightRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //logo
    const LOGO_DISPLAY_POSITION = array(
        'UP_AND_DOWN' => 0, //上下
        'LEFT_AND_RIGHT' => 1 //左右
    );
    protected function logoValidate($content) : bool
    {
        if (!isset($content['displayPosition']) || !isset($content['picture'])) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'logoKeys'));
            return false;
        }

        $displayPosition = $content['displayPosition'];
        if (!V::numeric()->validate($displayPosition) || !in_array($displayPosition, self::LOGO_DISPLAY_POSITION)) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'logoDisplayPosition')
            );
            return false;
        }

        if (!$this->getCommonWidgetRule()->picture($content['picture'])) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'logoPicture'));
            return false;
        }
        
        return true;
    }

    //theme
    protected function themeValidate($content) : bool
    {
        if (!isset($content['color']) || !isset($content['picture'])) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'themeRequiredKeys'));
            return false;
        }

        if (!$this->getCommonWidgetRule()->picture($content['picture'])) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'themePicture'));
            return false;
        }
        
        return true;
    }

    //headerBackGround
    protected function headerBackGroundValidate($content) : bool
    {
        if (!$this->getCommonWidgetRule()->picture($content)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'headerBackGround'));
            return false;
        }
        
        return true;
    }

    //headerSearch
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function headerSearchValidate($content) : bool
    {
        if (!isset($content['creditInfo']) || !isset($content['unifiedIdentifier']) || !isset($content['article'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerSearchRequiredKeys')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->headerSearchKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->headerSearchPlaceholderValidate($value['placeholder'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function headerSearchKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['placeholder']) ||
            !isset($content['link']) || !isset($content['status'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerSearchRequiredKeys')
            );
            return false;
        }

        return true;
    }

    protected function headerSearchPlaceholderValidate($placeholder) : bool
    {
        if (!$this->getCommonWidgetRule()->description($placeholder)) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'headerSearchPlaceholder')
            );
            return false;
        }

        return true;
    }

    //mainNav
    const MAIN_NAV_MAX_COUNT = 16;
    protected function mainNavValidate($content) : bool
    {
        if (count($content) > self::MAIN_NAV_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'mainNavCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->mainNavKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->mainNavTypeValidate($value['navType'])
                && $this->diyContentIntValidate($value['articleCategory'], 'mainNavArticleCategory')
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function mainNavKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['navType']) ||
            !isset($content['link']) || !isset($content['status']) || !isset($content['articleCategory'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'mainNavRequiredKeys')
            );
            return false;
        }

        return true;
    }

    const MAIN_NAV_TYPE = array(
        'OTHER' => 0, //其他类-默认,
        'ARTICLE' => 1, //新闻类
    );
    protected function mainNavTypeValidate($navType)
    {
        if (!V::numeric()->validate($navType) || !in_array($navType, self::MAIN_NAV_TYPE)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'mainNavType'));
            return false;
        }

        return true;
    }

    //topFloatingWindow
    const TOP_FLOATING_WINDOW_DISPLAY_STYLE = array(
        'HEADLINE_NEWS' => 0, //头条新闻
        'SLIDES' => 1 //轮播图
    );
    protected function topFloatingWindowValidate($content) : bool
    {
        if (!($this->topFloatingWindowKeysValidate($content)
            && $this->topFloatingWindowDisplayStyleValidate($content)
            && $this->topFloatingWindowSlidesValidate($content)
        )) {
            return false;
        }

        return true;
    }

    protected function topFloatingWindowKeysValidate($content) : bool
    {
        if (!isset($content['displayStyle']) || !isset($content['slides'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topFloatingWindowKeys')
            );
            return false;
        }

        return true;
    }

    protected function topFloatingWindowDisplayStyleValidate($content) : bool
    {
        $displayStyle = $content['displayStyle'];
        if (!V::numeric()->validate($displayStyle) ||
            !in_array($displayStyle, self::TOP_FLOATING_WINDOW_DISPLAY_STYLE)
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topFloatingWindowDisplayStyle')
            );
            return false;
        }

        return true;
    }

    protected function topFloatingWindowSlidesValidate($content) : bool
    {
        $slides = $content['slides'];
        $displayStyle = $content['displayStyle'];

        return ($displayStyle != self::TOP_FLOATING_WINDOW_DISPLAY_STYLE['SLIDES'] ?
                $this->topFloatingWindowSlidesEmptyValidate($slides) :
                $this->topFloatingWindowSlidesNotEmptyValidate($slides));
    }

    protected function topFloatingWindowSlidesEmptyValidate($slides) : bool
    {
        if (!empty($slides)) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topFloatingWindowSlides')
            );
            return false;
        }

        return true;
    }

    const TOP_FLOATING_WINDOW_SLIDES_MAX_COUNT = 5;
    protected function topFloatingWindowSlidesNotEmptyValidate($slides) : bool
    {
        if (count($slides) > self::TOP_FLOATING_WINDOW_SLIDES_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topFloatingWindowSlidesCount')
            );
            return false;
        }

        foreach ($slides as $slide) {
            if (!($this->topFloatingWindowSlidesKeysValidate($slide)
                && $this->diyContentNameValidate($slide['name'])
                && $this->diyContentLinkValidate($slide['link'])
                && $this->diyContentPictureValidate($slide['picture'])
                && $this->diyContentStatusValidate($slide['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function topFloatingWindowSlidesKeysValidate($slide)
    {
        if (!isset($slide['name']) || !isset($slide['picture']) ||
            !isset($slide['link']) || !isset($slide['status'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topFloatingWindowSlidesKeys')
            );
            return false;
        }

        return true;
    }

    //searchNav
    const SEARCH_NAV_MAX_COUNT = 20;
    protected function searchNavValidate($content) : bool
    {
        if (count($content) > self::SEARCH_NAV_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'searchNavCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->searchNavKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentPictureValidate($value['picture'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function searchNavKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['picture']) ||
            !isset($content['link']) || !isset($content['status'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'searchNavRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //articleContent
    const ARTICLE_CONTENT_COUNT = 6;
    protected function articleContentValidate($content) : bool
    {
        if (count($content) != self::ARTICLE_CONTENT_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'articleContentCount')
            );
            return false;
        }
        
        foreach ($content as $value) {
            if (!($this->articleContentKeysValidate($value)
                && $this->diyContentIntValidate($value['category'], 'articleContentCategory')
                && $this->diyContentIntValidate($value['count'], 'articleContentCount'))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function articleContentKeysValidate($content)
    {
        if (!isset($content['category']) || !isset($content['count'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'articleContentRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //topicColumn
    const TOPIC_COLUMN_COUNT = 2;
    protected function topicColumnValidate($content) : bool
    {
        if (count($content) != self::TOPIC_COLUMN_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topicColumnCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->topicColumnKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentPictureValidate($value['picture']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function topicColumnKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['picture']) || !isset($content['link'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'topicColumnRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //statistics
    protected function statisticsValidate($content) : bool
    {
        if (!isset($content['sgsStatus']) || !isset($content['hhmdStatus']) || !isset($content['xycnStatus'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'statisticsRequiredKeys')
            );
            return false;
        }

        if (!($this->diyContentStatusValidate($content['sgsStatus'])
            && $this->diyContentStatusValidate($content['hhmdStatus'])
            && $this->diyContentStatusValidate($content['xycnStatus'])
        )) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'statistics')
            );
            return false;
        }

        return true;
    }

    //relevantSlides
    const RELEVANT_SLIDES_MAX_COUNT = 20;
    protected function relevantSlidesValidate($content) : bool
    {
        if (count($content) > self::RELEVANT_SLIDES_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'relevantSlidesCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->relevantSlidesKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentPictureValidate($value['picture'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function relevantSlidesKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['picture']) ||
            !isset($content['link']) || !isset($content['status'])
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'relevantSlidesRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //relatedLinks
    const RELATED_LINKS_MAX_COUNT = 5;
    protected function relatedLinksValidate($content) : bool
    {
        if (count($content) > self::RELATED_LINKS_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'relatedLinksCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->relatedLinksKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->relatedLinksItemsValidate($value['items'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function relatedLinksKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['items']) || !isset($content['status'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'relatedLinksRequiredKeys')
            );
            return false;
        }

        return true;
    }
    
    const RELATED_LINKS_ITEMS_MAX_COUNT = 100;
    protected function relatedLinksItemsValidate($items)
    {
        if (count($items) > self::RELATED_LINKS_ITEMS_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'relatedLinksItemsCount')
            );
            return false;
        }

        foreach ($items as $item) {
            if (!isset($item['name']) || !isset($item['link']) || !isset($item['status'])) {
                Core::setLastError(
                    HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'relatedLinksItemsRequiredKeys')
                );
                return false;
            }

            if (!($this->diyContentNameValidate($item['name'])
                && $this->diyContentLinkValidate($item['link'])
                && $this->diyContentStatusValidate($item['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    //partyAndGovernmentOrgans
    protected function partyAndGovernmentOrgansValidate($content) : bool
    {
        if (!isset($content['link']) || !isset($content['status']) || !isset($content['displayPosition'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'partyAndGovernmentOrgansRequiredKeys')
            );
            return false;
        }

        if (!($this->diyContentLinkValidate($content['link'])
            && $this->diyContentStatusValidate($content['status'])
            && $this->diyContentDisplayPositionValidate($content['displayPosition'])
        )) {
            return false;
        }

        return true;
    }

    //governmentWebsiteErrorCorrection
    protected function governmentWebsiteErrorCorrectionValidate($content) : bool
    {
        if (!isset($content['link']) || !isset($content['status']) || !isset($content['displayPosition'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'governmentWebsiteErrorCorrectionRequiredKeys')
            );
            return false;
        }

        if (!($this->diyContentLinkValidate($content['link'])
            && $this->diyContentStatusValidate($content['status'])
            && $this->diyContentDisplayPositionValidate($content['displayPosition'])
        )) {
            return false;
        }
        
        return true;
    }

    //footerOne
    const FOOTER_ONE_MAX_COUNT = 10;
    protected function footerOneValidate($content) : bool
    {
        if (count($content) > self::FOOTER_ONE_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerOneCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->footerOneKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function footerOneKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['link']) || !isset($content['status'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerOneRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //footerTwo
    const FOOTER_TWO_MAX_COUNT = 5;
    protected function footerTwoValidate($content) : bool
    {
        if (count($content) > self::FOOTER_TWO_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerTwoCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->footerTwoKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentValueValidate($value['value'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function footerTwoKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['value']) || !isset($content['status'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerTwoRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //footerThree
    const FOOTER_THREE_MAX_COUNT = 5;
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function footerThreeValidate($content) : bool
    {
        if (count($content) > self::FOOTER_THREE_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerThreeCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->footerThreeKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentValueValidate($value['value'])
                && (empty($value['link']) ? true : $this->diyContentLinkValidate($value['link']))
                && (empty($value['picture']) ? true : $this->diyContentPictureValidate($value['picture']))
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function footerThreeKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['value']) ||
            !isset($content['status'])|| !isset($content['link']) || !isset($content['picture'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'footerThreeRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //middlePopBox
    protected function middlePopBoxValidate($content) : bool
    {
        if (!($this->middlePopBoxKeysValidate($content)
            && (empty($content['link']) ? true : $this->diyContentLinkValidate($content['link']))
            && $this->diyContentPictureValidate($content['picture'])
            && $this->diyContentStatusValidate($content['status']))
        ) {
            return false;
        }

        return true;
    }

    protected function middlePopBoxKeysValidate($content)
    {
        if (!isset($content['status'])|| !isset($content['link']) || !isset($content['picture'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'middlePopBoxRequiredKeys')
            );
            return false;
        }

        return true;
    }

    //bayWindow
    const BAY_WINDOW_MAX_COUNT = 2;
    protected function bayWindowValidate($content) : bool
    {
        if (count($content) > self::BAY_WINDOW_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'bayWindowCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->bayWindowKeysValidate($value)
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentPictureValidate($value['picture'])
                && $this->diyContentStatusValidate($value['status']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function bayWindowKeysValidate($content)
    {
        if (!isset($content['status'])|| !isset($content['link']) || !isset($content['picture'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'bayWindowRequiredKeys')
            );
            return false;
        }

        return true;
    }
    
    //rightNav
    const RIGHT_NAV_MAX_COUNT = 20;
     /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function rightNavValidate($content) : bool
    {
        if (count($content) > self::RIGHT_NAV_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'rightNavCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->rightNavKeysValidate($value)
                && $this->diyContentPictureValidate($value['icon'])
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentTypeValidate($value['type'])
                && $this->diyContentLinkValidate($value['link'], $value['type'])
                && $this->diyContentStatusValidate($value['status'])
                && (empty($value['pictures']) ? true : $this->rightNavPicturesValidate($value['pictures']))
                && (empty($value['description']) ? true : $this->diyContentValueValidate($value['description'])))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function rightNavKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['icon']) ||
            !isset($content['status'])|| !isset($content['link']) ||
            !isset($content['type']) || !isset($content['pictures']) || !isset($content['description'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'rightNavRequiredKeys')
            );
            return false;
        }

        return true;
    }

    protected function rightNavPicturesValidate($pictures) : bool
    {
        if (!$this->getCommonWidgetRule()->pictures($pictures)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'rightNavPictures'));
            return false;
        }

        return true;
    }
    
    //leftFloatingWindow
    const LEFT_FLOATING_WINDOW_MAX_COUNT = 5;
    protected function leftFloatingWindowValidate($content) : bool
    {
        if (count($content) > self::LEFT_FLOATING_WINDOW_MAX_COUNT) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'leftFloatingWindowCount')
            );
            return false;
        }

        foreach ($content as $value) {
            if (!($this->leftFloatingWindowKeysValidate($value)
                && $this->diyContentNameValidate($value['name'])
                && $this->diyContentLinkValidate($value['link'])
                && $this->diyContentStatusValidate($value['status'])
                && $this->diyContentPictureValidate($value['picture']))
            ) {
                return false;
            }
        }

        return true;
    }

    protected function leftFloatingWindowKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['status'])|| !isset($content['link']) ||
            !isset($content['picture'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'leftFloatingWindowRequiredKeys')
            );
            return false;
        }

        return true;
    }

    const WEBSITE_STYLE = array(
        'DEFAULT' => 0, //默认
        'MOURNING' => 1 //悼念
    );
    protected function websiteStyleValidate($websiteStyle)
    {
        if (!V::numeric()->validate($websiteStyle) || !in_array($websiteStyle, self::WEBSITE_STYLE)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'websiteStyle'));
            return false;
        }

        return true;
    }

    //silhouette
    protected function silhouetteValidate($content) : bool
    {
        if (!($this->silhouetteKeysValidate($content)
            && $this->diyContentNameValidate($content['name'])
            && $this->diyContentStatusValidate($content['status'])
            && $this->diyContentPictureValidate($content['picture'])
            && (empty($content['description']) ? true : $this->diyContentValueValidate($content['description'])))
        ) {
            return false;
        }

        return true;
    }

    protected function silhouetteKeysValidate($content)
    {
        if (!isset($content['name']) || !isset($content['status']) ||
            !isset($content['picture']) || !isset($content['description'])) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'silhouetteRequiredKeys')
            );
            return false;
        }

        return true;
    }

    protected function diyContentTypeValidate($type)
    {
        if (!V::numeric()->validate($type) || !in_array($type, self::DIY_CONTENT_TYPE)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentType'));
            return false;
        }

        return true;
    }

    protected function diyContentDisplayPositionValidate($displayPosition)
    {
        if (!V::numeric()->validate($displayPosition) ||
            !in_array($displayPosition, self::DIY_CONTENT_DISPLAY_POSITION)
        ) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'diyContentDisplayPosition')
            );
            return false;
        }

        return true;
    }

    protected function diyContentCodeTypeValidate($codeType)
    {
        if (!V::numeric()->validate($codeType) || !in_array($codeType, self::DIY_CONTENT_CODE_TYPE)) {
            Core::setLastError(
                HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                array('pointer' => 'diyContentCodeType')
            );
            return false;
        }

        return true;
    }

    const LINK_MIN_LENGTH = 1;
    const LINK_MAX_LENGTH = 200;
    //验证名称长度：1-20个字符
    protected function diyContentLinkValidate($link, $type = self::DIY_CONTENT_TYPE['LINK']) : bool
    {
        if ($type == self::DIY_CONTENT_TYPE['LINK']) {
            if (!V::stringType()->length(self::LINK_MIN_LENGTH, self::LINK_MAX_LENGTH)->validate($link)) {
                Core::setLastError(
                    HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'diyContentLink')
                );
                return false;
            }
        }

        if ($type != self::DIY_CONTENT_TYPE['LINK']) {
            if (!empty($link)) {
                Core::setLastError(
                    HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT,
                    array('pointer' => 'diyContentLink')
                );
                return false;
            }
        }

        return true;
    }

    protected function diyContentNameValidate($name) : bool
    {
        if (!$this->getCommonWidgetRule()->name($name)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentName'));
            return false;
        }

        return true;
    }

    protected function diyContentStatusValidate($status) : bool
    {
        if (!$this->getCommonWidgetRule()->status($status)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentStatus'));
            return false;
        }

        return true;
    }

    protected function diyContentPictureValidate($picture) : bool
    {
        if (!$this->getCommonWidgetRule()->picture($picture)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentPicture'));
            return false;
        }

        return true;
    }

    protected function diyContentIntValidate($content, $pointer = '') : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($content)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => $pointer));
            return false;
        }

        return true;
    }

    protected function diyContentValueValidate($value) : bool
    {
        if (!$this->getCommonWidgetRule()->description($value)) {
            Core::setLastError(HOME_PAGE_CONFIG_DIY_CONTENT_FORMAT_INCORRECT, array('pointer' => 'diyContentValue'));
            return false;
        }

        return true;
    }
}

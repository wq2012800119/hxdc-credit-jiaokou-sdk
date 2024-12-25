<?php
namespace Sdk\Article\Category\WidgetRule;

use Marmot\Core;

use Respect\Validation\Validator as V;

use Sdk\Article\Category\Model\Category;
use Sdk\Common\WidgetRule\CommonWidgetRule;

class CategoryWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function level($level) : bool
    {
        if (!V::numeric()->positive()->validate($level) || !in_array($level, Category::LEVEL)) {
            Core::setLastError(ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function style($style) : bool
    {
        if (!V::numeric()->positive()->validate($style) || !in_array($style, Category::STYLE)) {
            Core::setLastError(ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function parentCategory($parentCategory, $level) : bool
    {
        if (!V::numeric()->validate($parentCategory)) {
            Core::setLastError(ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        if ($level == Category::LEVEL['ONE_LEVEL'] && !empty($parentCategory)) {
            Core::setLastError(ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    /** 验证自定义内容格式
     * 1. 验证是否为数组格式
     * 2. 验证数组的健值,是否包含'slidesPictureDisplayStatus', 'rightToolbarDisplayStatus', 'childrenCategories'
     * 3. slidesPictureDisplayStatus 验证状态是否在范围内
     * 4. rightToolbarDisplayStatus 验证状态是否在范围内
     * 5. childrenCategories 验证是否为数组, 根据不同的风格验证,分类id格式是否正确, 验证图片格式是否正确, 验证子类是否重复
     */
    public function diyContent($diyContent, $style) : bool
    {
        return $this->diyContentTypeFormatValidate($diyContent)
            && $this->diyContentKeysFormatValidate($diyContent)
            && $this->diyContentSlidesPictureDisplayStatusValidate($diyContent)
            && $this->diyContentRightToolbarDisplayStatusValidate($diyContent)
            && $this->diyContentChildrenCategoriesValidate($diyContent, $style);
    }

    //1. 验证是否为数组格式
    protected function diyContentTypeFormatValidate($diyContent) : bool
    {
        if (!V::arrayType()->validate($diyContent) || empty($diyContent)) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //2. 验证数组的健值,是否包含'slidesPictureDisplayStatus', 'rightToolbarDisplayStatus', 'childrenCategories'
    const DIY_CONTENT_KEYS = array('slidesPictureDisplayStatus', 'rightToolbarDisplayStatus', 'childrenCategories');
    protected function diyContentKeysFormatValidate($diyContent) : bool
    {
        $diyContentKeys = array_keys($diyContent);
        if (!empty(array_diff($diyContentKeys, self::DIY_CONTENT_KEYS))
            || !empty(array_diff(self::DIY_CONTENT_KEYS, $diyContentKeys))
        ) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //3. slidesPictureDisplayStatus 验证状态是否在范围内
    protected function diyContentSlidesPictureDisplayStatusValidate($diyContent) : bool
    {
        if (!isset($diyContent['slidesPictureDisplayStatus'])) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->status(
            $diyContent['slidesPictureDisplayStatus'],
            'slidesPictureDisplayStatus'
        )) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }
        
        return true;
    }

    //4. rightToolbarDisplayStatus 验证状态是否在范围内
    protected function diyContentRightToolbarDisplayStatusValidate($diyContent) : bool
    {
        if (!isset($diyContent['rightToolbarDisplayStatus'])) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->status(
            $diyContent['rightToolbarDisplayStatus'],
            'rightToolbarDisplayStatus'
        )) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }
        
        return true;
    }

    //5. childrenCategories 验证是否为数组, 根据不同的风格验证,分类id格式是否正确, 验证图片格式是否正确, 验证子类是否重复
    protected function diyContentChildrenCategoriesValidate($diyContent, $style) : bool
    {
        return $this->diyContentChildrenCategoriesTypeFormatValidate($diyContent)
            && $this->diyContentChildrenCategoriesUniqueValidate($diyContent)
            && $this->diyContentChildrenCategoriesFormatValidate($diyContent, $style);
    }
    
    protected function diyContentChildrenCategoriesTypeFormatValidate($diyContent) : bool
    {
        if (!isset($diyContent['childrenCategories'])) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        $childrenCategories = $diyContent['childrenCategories'];
        if (!V::arrayType()->validate($childrenCategories) || empty($childrenCategories)) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    
    protected function diyContentChildrenCategoriesUniqueValidate($diyContent) : bool
    {
        $categoryList = array_column($diyContent['childrenCategories'], 'category');
        if (count($categoryList) != count(array_unique($categoryList))) {
            Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    
    protected function diyContentChildrenCategoriesFormatValidate($diyContent, $style) : bool
    {
        $childrenCategories = $diyContent['childrenCategories'];

        foreach ($childrenCategories as $childrenCategory) {
            if (!isset($childrenCategory['category']) || !isset($childrenCategory['status'])) {
                Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->isNumericType($childrenCategory['category'])) {
                Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!$this->getCommonWidgetRule()->status($childrenCategory['status'])) {
                Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
                return false;
            }
            if ($style == Category::STYLE['STYLE_ONE']) {
                if (!isset($childrenCategory['picture'])) {
                    Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
                    return false;
                }
                if (!$this->getCommonWidgetRule()->picture($childrenCategory['picture'])) {
                    Core::setLastError(ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT);
                    return false;
                }
            }
        }

        return true;
    }
}

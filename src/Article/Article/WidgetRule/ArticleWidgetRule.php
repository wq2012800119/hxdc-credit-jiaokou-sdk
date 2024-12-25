<?php
namespace Sdk\Article\Article\WidgetRule;

use Marmot\Core;

use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Article\Article\Model\Article;

class ArticleWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }
    
    const SOURCE_MIN_LENGTH = 1;
    const SOURCE_MAX_LENGTH = 20;
    //验证来源长度：1-20个字符
    public function source($source) : bool
    {
        if (!V::stringType()->length(self::SOURCE_MIN_LENGTH, self::SOURCE_MAX_LENGTH)->validate($source)) {
            Core::setLastError(ARTICLE_SOURCE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    //发布时间: 时间格式
    public function pubDate($pubDate) : bool
    {
        if (!is_numeric($pubDate) || strtotime(date('Y-m-d H:i:s', $pubDate)) != $pubDate) {
            Core::setLastError(ARTICLE_PUB_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ATTACHMENTS_MAX_COUNT = 5;
    //附件: 最多可上传5个文件, 格式: doc、docx、xls、xlsx、pdf、zip、rar、lzh、jar、ppt、txt
    public function attachments($attachments) : bool
    {
        if (!V::arrayType()->validate($attachments)) {
            Core::setLastError(ARTICLE_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        if (count($attachments) > self::ATTACHMENTS_MAX_COUNT) {
            Core::setLastError(ARTICLE_ATTACHMENTS_COUNT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->attachments($attachments)) {
            Core::setLastError(ARTICLE_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    const CONTENT_MAX_COUNT = 10;
    const CONTENT_TYPE = array('picture', 'text');
    const CONTENT_VALUE_MIN_LENGTH = 1;
    const CONTENT_VALUE_MAX_LENGTH = 50000;
    //内容: 不超过10个, 长度：1-50000个字符
    public function content($content) : bool
    {
        if (!V::arrayType()->validate($content)) {
            Core::setLastError(CONTENT_FORMAT_INCORRECT);
            return false;
        }

        if (count($content) > self::CONTENT_MAX_COUNT) {
            Core::setLastError(ARTICLE_CONTENT_COUNT_INCORRECT);
            return false;
        }
        
        foreach ($content as $each) {
            if (!isset($each['type']) || !isset($each['value'])) {
                Core::setLastError(CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!in_array($each['type'], self::CONTENT_TYPE)) {
                Core::setLastError(CONTENT_FORMAT_INCORRECT);
                return false;
            }

            if (!V::stringType()->length(
                self::CONTENT_VALUE_MIN_LENGTH,
                self::CONTENT_VALUE_MAX_LENGTH
            )->validate($each['value'])) {
                Core::setLastError(CONTENT_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    public function isSlides($isSlides) : bool
    {
        if (!V::numeric()->validate($isSlides) || !in_array($isSlides, Article::IS_SLIDES)) {
            Core::setLastError(ARTICLE_IS_SLIDES_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function isHomeSlides($isHomeSlides, $isSlides) : bool
    {
        if (!V::numeric()->validate($isHomeSlides) || !in_array($isHomeSlides, Article::IS_HOME_SLIDES)) {
            Core::setLastError(ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT);
            return false;
        }

        if ($isSlides == Article::IS_SLIDES['NO'] && $isHomeSlides == Article::IS_HOME_SLIDES['YES']) {
            Core::setLastError(ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function slidesPicture($slidesPicture, $isSlides) : bool
    {
        if (!V::arrayType()->validate($slidesPicture)) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT);
            return false;
        }

        if ($isSlides == Article::IS_SLIDES['NO'] && !empty($slidesPicture)) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => 'slidesPicture'));
            return false;
        }

        if ($isSlides != Article::IS_SLIDES['NO'] && !$this->getCommonWidgetRule()->picture($slidesPicture)) {
            Core::setLastError(PICTURE_FORMAT_INCORRECT, array('pointer' => 'slidesPicture'));
            return false;
        }

        return true;
    }
}

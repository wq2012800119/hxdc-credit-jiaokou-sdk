<?php
namespace Sdk\Article\Article\Utils;

use Marmot\Framework\Classes\Filter;

use Sdk\Article\Article\Model\Article;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Article $article, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $article->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['title'])) {
            $this->assertEquals($attributes['title'], $article->getTitle());
        }
        if (isset($attributes['source'])) {
            $this->assertEquals($attributes['source'], $article->getSource());
        }
        if (isset($attributes['pubDate'])) {
            $this->assertEquals($attributes['pubDate'], $article->getPubDate());
        }
        if (isset($attributes['description'])) {
            $this->assertEquals($attributes['description'], $article->getDescription());
        }
        if (isset($attributes['cover'])) {
            $this->assertEquals($attributes['cover'], $article->getCover());
        }
        if (isset($attributes['attachments'])) {
            $this->assertEquals($attributes['attachments'], $article->getAttachments());
        }
        if (isset($attributes['content'])) {
            $this->assertEquals($attributes['content'], $article->getContent());
        }
        if (isset($attributes['isSlides'])) {
            $this->assertEquals($attributes['isSlides'], $article->getIsSlides());
        }
        if (isset($attributes['isHomeSlides'])) {
            $this->assertEquals($attributes['isHomeSlides'], $article->getIsHomeSlides());
        }
        if (isset($attributes['slidesPicture'])) {
            $this->assertEquals($attributes['slidesPicture'], $article->getSlidesPicture());
        }
        if (isset($attributes['topStatus'])) {
            $this->assertEquals($attributes['topStatus'], $article->getTopStatus());
        }
        if (isset($attributes['examineStatus'])) {
            $this->assertEquals($attributes['examineStatus'], $article->getExamineStatus());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $article->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $article->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $article->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $article->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['category']['data'])) {
            $category = $relationships['category']['data'];
            $this->assertEquals($category['type'], 'articleCategories');
            $this->assertEquals($category['id'], $article->getCategory()->getId());
        }
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $article->getStaff()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Article $article)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($article->getId()));
        }
        if (isset($expression['title'])) {
            $this->assertEquals($expression['title'], $article->getTitle());
        }
        if (isset($expression['source'])) {
            $this->assertEquals($expression['source'], $article->getSource());
        }
        if (isset($expression['pubDate'])) {
            $this->assertEquals($expression['pubDate'], $article->getPubDate());
            $this->assertEquals(
                $expression['pubDateFormatConvert'],
                date('Y-m-d', $article->getPubDate())
            );
        }
        if (isset($expression['description'])) {
            $this->assertEquals($expression['description'], $article->getDescription());
        }
        if (isset($expression['cover'])) {
            $this->assertEquals($expression['cover'], $article->getCover());
        }
        if (isset($expression['attachments'])) {
            $this->assertEquals($expression['attachments'], $article->getAttachments());
        }
        if (isset($expression['content'])) {
            $this->assertEquals($expression['content'], Filter::dhtmlspecialchars($article->getContent()));
        }
        if (isset($expression['slidesPicture'])) {
            $this->assertEquals($expression['slidesPicture'], $article->getSlidesPicture());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $article->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $article->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $article->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $article->getUpdateTime())
            );
        }
    }
}

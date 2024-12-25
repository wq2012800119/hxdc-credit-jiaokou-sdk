<?php
namespace Sdk\Dictionary\Item\Utils;

use Sdk\Dictionary\Item\Model\Item;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Item $item, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $item->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $item->getName());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $item->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $item->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $item->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $item->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['dictionaryCategory']['data'])) {
            $dictionaryCategory = $relationships['dictionaryCategory']['data'];
            $this->assertEquals($dictionaryCategory['type'], 'dictionaryCategories');
            $this->assertEquals($dictionaryCategory['id'], $item->getCategory()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Item $item)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($item->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $item->getName());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $item->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $item->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $item->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $item->getUpdateTime())
            );
        }
    }
}

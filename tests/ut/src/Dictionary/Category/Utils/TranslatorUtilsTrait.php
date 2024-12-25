<?php
namespace Sdk\Dictionary\Category\Utils;

use Sdk\Dictionary\Category\Model\Category;

trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Category $category, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $category->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();

        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $category->getName());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $category->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $category->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $category->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $category->getUpdateTime());
        }
    }

    public function compareTranslatorEquals(array $expression, Category $category)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($category->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $category->getName());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $category->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $category->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $category->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $category->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $category->getUpdateTime())
            );
        }
    }
}

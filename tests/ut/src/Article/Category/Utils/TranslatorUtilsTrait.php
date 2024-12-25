<?php
namespace Sdk\Article\Category\Utils;

use Sdk\Article\Category\Model\Category;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
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
        if (isset($attributes['style'])) {
            $this->assertEquals($attributes['style'], $category->getStyle());
        }
        if (isset($attributes['diyContent'])) {
            $this->assertEquals($attributes['diyContent'], $category->getDiyContent());
        }
        if (isset($attributes['parentCategory'])) {
            $this->assertEquals($attributes['parentCategory'], $category->getParentCategoryId());
            $level = empty($attributes['parentCategory']) ?
                Category::LEVEL['ONE_LEVEL'] :
                Category::LEVEL['SECOND_LEVEL'];
            $this->assertEquals($level, $category->getLevel());
        }
        if (isset($attributes['parentCategoryName'])) {
            $this->assertEquals($attributes['parentCategoryName'], $category->getParentCategoryName());
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

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $category->getStaff()->getId());
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
        if (isset($expression['parentCategory'])) {
            $this->assertEquals(
                $expression['parentCategory'],
                array(
                    'id' => marmot_encode($category->getParentCategoryId()),
                    'name' => $category->getParentCategoryName()
                )
            );
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

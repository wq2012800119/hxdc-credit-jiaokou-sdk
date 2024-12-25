<?php
namespace Sdk\Dictionary\Category\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Dictionary\Category\Model\Category;
use Sdk\Dictionary\Category\Model\NullCategory;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class CategoryRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $category = null)
    {
        if (empty($expression)) {
            return NullCategory::getInstance();
        }

        if ($category == null) {
            $category = new Category();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();

        if (isset($data['id'])) {
            $category->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $category->setName($attributes['name']);
        }
        if (isset($attributes['status'])) {
            $category->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $category->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $category->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $category->setUpdateTime($attributes['updateTime']);
        }

        return $category;
    }

    public function objectToArray($category, array $keys = array())
    {
        unset($category);
        unset($keys);
        return [];
    }
}

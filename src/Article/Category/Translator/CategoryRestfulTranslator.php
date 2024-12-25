<?php
namespace Sdk\Article\Category\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Model\NullCategory;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class CategoryRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

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
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $category->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $category->setName($attributes['name']);
        }
        if (isset($attributes['style'])) {
            $category->setStyle($attributes['style']);
        }
        if (isset($attributes['diyContent'])) {
            $category->setDiyContent($attributes['diyContent']);
        }
        if (isset($attributes['parentCategory'])) {
            $category->setParentCategoryId($attributes['parentCategory']);
            $level = Category::LEVEL['ONE_LEVEL'];
            if (!empty($attributes['parentCategory'])) {
                $level = Category::LEVEL['SECOND_LEVEL'];
            }
            $category->setLevel($level);
        }
        if (isset($attributes['parentCategoryName'])) {
            $category->setParentCategoryName($attributes['parentCategoryName']);
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

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $category->setStaff($staff);
        }

        return $category;
    }

    public function objectToArray($category, array $keys = array())
    {
        if (!$category instanceof Category) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'level',
                'style',
                'diyContent',
                'parentCategory',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'articleCategories'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $category->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $category->getName();
        }
        if (in_array('level', $keys)) {
            $attributes['level'] = $category->getLevel();
        }
        if (in_array('style', $keys)) {
            $attributes['style'] = $category->getStyle();
        }
        if (in_array('diyContent', $keys)) {
            $attributes['diyContent'] = $category->getDiyContent();
        }
        if (in_array('parentCategory', $keys)) {
            $attributes['parentCategory'] = $category->getParentCategoryId();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($category->getStaff()->getId())
            );
        }

        return $expression;
    }
}

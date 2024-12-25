<?php
namespace Sdk\Article\Category\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Model\NullCategory;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class CategoryTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullCategory::getInstance();
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
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($category->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $category->getName();
        }
        if (in_array('level', $keys)) {
            $expression['level'] = $this->typeFormatConversion($category->getLevel(), Category::LEVEL_CN);
        }
        if (in_array('style', $keys)) {
            $expression['style'] = $this->typeFormatConversion($category->getStyle(), Category::STYLE_CN);
        }
        if (in_array('diyContent', $keys)) {
            $expression['diyContent'] = $this->diyContentFormatConversion($category->getDiyContent());
        }
        if (in_array('parentCategory', $keys)) {
            $expression['parentCategory'] = array(
                'id' => marmot_encode($category->getParentCategoryId()),
                'name' => $category->getParentCategoryName()
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $category->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $category->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $category->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $category->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $category->getUpdateTime());
        }

        return $expression;
    }

    protected function diyContentFormatConversion(array $diyContent) : array
    {
        $diyContent['slidesPictureDisplayStatus'] = isset($diyContent['slidesPictureDisplayStatus']) ?
            marmot_encode($diyContent['slidesPictureDisplayStatus']) : marmot_encode(0);

        $diyContent['rightToolbarDisplayStatus'] = isset($diyContent['rightToolbarDisplayStatus']) ?
        marmot_encode($diyContent['rightToolbarDisplayStatus']) : marmot_encode(0);

        if (isset($diyContent['childrenCategories'])) {
            foreach ($diyContent['childrenCategories'] as $key => $each) {
                if (isset($each['category'])) {
                    $diyContent['childrenCategories'][$key]['category'] = marmot_encode($each['category']);
                }
                if (isset($each['status'])) {
                    $diyContent['childrenCategories'][$key]['status'] =  marmot_encode($each['status']);
                }
            }
        }

        return $diyContent;
    }
}

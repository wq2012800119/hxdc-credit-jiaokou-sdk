<?php
namespace Sdk\Dictionary\Category\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Dictionary\Category\Model\Category;
use Sdk\Dictionary\Category\Model\NullCategory;

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
}

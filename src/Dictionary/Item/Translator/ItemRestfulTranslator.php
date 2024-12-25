<?php
namespace Sdk\Dictionary\Item\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Dictionary\Item\Model\Item;
use Sdk\Dictionary\Item\Model\NullItem;

use Sdk\Dictionary\Category\Translator\CategoryRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class ItemRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getCategoryRestfulTranslator() : CategoryRestfulTranslator
    {
        return new CategoryRestfulTranslator();
    }

    public function arrayToObject(array $expression, $item = null)
    {
        if (empty($expression)) {
            return NullItem::getInstance();
        }

        if ($item == null) {
            $item = new Item();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $item->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $item->setName($attributes['name']);
        }
        if (isset($attributes['status'])) {
            $item->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $item->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $item->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $item->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['dictionaryCategory'])) {
            $categoryArray = $this->relationshipFill($relationships['dictionaryCategory'], $included);

            $category = $this->getCategoryRestfulTranslator()->arrayToObject($categoryArray);
            $item->setCategory($category);
        }

        return $item;
    }

    public function objectToArray($item, array $keys = array())
    {
        if (!$item instanceof Item) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'dictionaryCategory'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'dictionaryItems'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $item->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $item->getName();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('dictionaryCategory', $keys)) {
            $expression['data']['relationships']['dictionaryCategory']['data'] = array(
                'type' => 'dictionaryCategories',
                'id' => strval($item->getCategory()->getId())
            );
        }
        
        return $expression;
    }
}

<?php
namespace Sdk\Dictionary\Item\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Dictionary\Item\Model\Item;
use Sdk\Dictionary\Item\Model\NullItem;

use Sdk\Dictionary\Category\Translator\CategoryTranslator;

class ItemTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getCategoryTranslator() : CategoryTranslator
    {
        return new CategoryTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullItem::getInstance();
    }
    
    /**
     * @todo
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($item, array $keys = array())
    {
        if (!$item instanceof Item) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'dictionaryCategory' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($item->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $item->getName();
        }
        if (isset($keys['dictionaryCategory'])) {
            $expression['dictionaryCategory'] = $this->getCategoryTranslator()->objectToArray(
                $item->getCategory(),
                $keys['dictionaryCategory']
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion($item->getStatus());
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $item->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $item->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $item->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $item->getUpdateTime());
        }

        return $expression;
    }
}

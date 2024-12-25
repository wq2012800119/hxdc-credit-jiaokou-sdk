<?php
namespace Sdk\Dictionary\Item\Adapter\Item;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Dictionary\Item\Model\NullItem;
use Sdk\Dictionary\Item\Translator\ItemRestfulTranslator;

class ItemRestfulAdapter extends CommonRestfulAdapter implements IItemAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'name' => NAME_FORMAT_INCORRECT,
            'dictionaryCategory' => DICTIONARY_CATEGORY_FORMAT_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => DICTIONARY_ITEM_NAME_EXISTS,
        100004 => DICTIONARY_CATEGORY_NOT_EXISTS
    );
    
    const SCENARIOS = [
        'ITEM_LIST'=>[
            'fields' => [
                'dictionaryItems'=>'name,dictionaryCategory,status,updateTime',
            ],
            'include' => 'dictionaryCategory'
        ],
        'ITEM_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'dictionaryCategory'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ItemRestfulTranslator(),
            'dictionaryItems',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullItem::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'name',
            'dictionaryCategory'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name'
        );
    }
}

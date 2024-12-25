<?php
namespace Sdk\Dictionary\Category\Adapter\Category;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;

use Sdk\Dictionary\Category\Model\NullCategory;
use Sdk\Dictionary\Category\Translator\CategoryRestfulTranslator;

class CategoryRestfulAdapter extends CommonRestfulAdapter implements ICategoryAdapter
{
    use FetchAbleRestfulAdapterTrait;
    
    const SCENARIOS = [
        'CATEGORY_LIST'=>[
            'fields' => [
                'dictionaryCategories'=>'name,updateTime',
            ],
            'include' => ''
        ],
        'CATEGORY_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>''
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CategoryRestfulTranslator(),
            'dictionaryCategories',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCategory::getInstance();
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
}

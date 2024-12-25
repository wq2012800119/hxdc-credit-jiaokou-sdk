<?php
namespace Sdk\Article\Category\Adapter\Category;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Article\Category\Model\Category;
use Sdk\Article\Category\Model\NullCategory;
use Sdk\Article\Category\Translator\CategoryRestfulTranslator;

class CategoryRestfulAdapter extends CommonRestfulAdapter implements ICategoryAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;
        
    const MAP_ERROR = array(
        100001 => array(
            'name' => NAME_FORMAT_INCORRECT,
            'level' => ARTICLE_CATEGORY_LEVEL_FORMAT_INCORRECT,
            'style' => ARTICLE_CATEGORY_STYLE_FORMAT_INCORRECT,
            'diyContent' => ARTICLE_CATEGORY_DIY_CONTENT_FORMAT_INCORRECT,
            'parentCategory' => ARTICLE_CATEGORY_PARENT_CATEGORY_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT
        ),
        100003 => ARTICLE_CATEGORY_NAME_EXISTS,
        100004 => array(
            'parentCategory' => ARTICLE_CATEGORY_PARENT_CATEGORY_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'CATEGORY_LIST'=>[
            'fields' => [
                'articleCategories'=>'name,level,parentCategory,updateTime,style',
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
            'articleCategories',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCategory::getInstance();
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
            'level',
            'parentCategory',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'staff'
        );
    }

    public function diy(Category $category) : bool
    {
        $data = $this->getTranslator()->objectToArray($category, array('style', 'diyContent'));
       
        $this->patch(
            $this->getResource().'/'.$category->getId().'/diy',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($category);
            return true;
        }

        return false;
    }
}

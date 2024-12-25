<?php
namespace Sdk\Article\Article\Adapter\Article;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\TopAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Article\Model\NullArticle;
use Sdk\Article\Article\Translator\ArticleRestfulTranslator;
use Sdk\Sensitive\Result\Model\NullSensitiveResult;
use Sdk\Sensitive\Result\Model\SensitiveResult;
use Sdk\Sensitive\Result\Translator\SensitiveResultRestfulTranslator;

class ArticleRestfulAdapter extends CommonRestfulAdapter implements IArticleAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        TopAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'title' => TITLE_FORMAT_INCORRECT,
            'source' => ARTICLE_SOURCE_FORMAT_INCORRECT,
            'category' => ARTICLE_CATEGORY_FORMAT_INCORRECT,
            'pubDate' => ARTICLE_PUB_DATE_FORMAT_INCORRECT,
            'description' => DESCRIPTION_FORMAT_INCORRECT,
            'cover' => PICTURE_FORMAT_INCORRECT,
            'attachments' => ARTICLE_ATTACHMENTS_FORMAT_INCORRECT,
            'content' => CONTENT_FORMAT_INCORRECT,
            'isSlides' => ARTICLE_IS_SLIDES_FORMAT_INCORRECT,
            'isHomeSlides' => ARTICLE_IS_HOME_SLIDES_FORMAT_INCORRECT,
            'slidesPicture' => PICTURE_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'category' => ARTICLE_CATEGORY_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'ARTICLE_LIST'=>[
            'fields' => [
                'articles'=>'title,category,organization,topStatus,status,examineStatus,updateTime',
            ],
            'include' => 'articleCategory,staff,organization'
        ],
        'ARTICLE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'articleCategory,staff,organization'
        ]
    ];

    private $sensitiveResultRestfulTranslator;

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ArticleRestfulTranslator(),
            'articles',
            $baseurl,
            $headers
        );

        $this->sensitiveResultRestfulTranslator = new SensitiveResultRestfulTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullArticle::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function getSensitiveResultRestfulTranslator() : SensitiveResultRestfulTranslator
    {
        return $this->sensitiveResultRestfulTranslator;
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'title',
            'source',
            'category',
            'pubDate',
            'description',
            'isSlides',
            'isHomeSlides',
            'slidesPicture',
            'cover',
            'attachments',
            'content',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'title',
            'source',
            'category',
            'pubDate',
            'description',
            'isSlides',
            'isHomeSlides',
            'slidesPicture',
            'cover',
            'attachments',
            'content'
        );
    }

    //单条新闻敏感词过滤
    public function process(Article $article) : SensitiveResult
    {
        $data = $this->getTranslator()->objectToArray($article, array('title', 'description', 'content'));

        $this->post(
            'sensitive/words/process',
            $data
        );
        
        return $this->isSuccess() ?
                $this->getSensitiveResultRestfulTranslator()->arrayToObject($this->getContents()) :
                NullSensitiveResult::getInstance();
    }
}

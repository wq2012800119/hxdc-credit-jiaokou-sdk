<?php
namespace Sdk\Sensitive\Result\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Sensitive\Result\Model\SensitiveResult;
use Sdk\Sensitive\Result\Model\NullSensitiveResult;

use Sdk\Article\Article\Translator\ArticleRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class SensitiveResultRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getArticleRestfulTranslator() : ArticleRestfulTranslator
    {
        return new ArticleRestfulTranslator();
    }

    public function arrayToObject(array $expression, $sensitiveResult = null)
    {
        if (empty($expression)) {
            return NullSensitiveResult::getInstance();
        }

        if ($sensitiveResult == null) {
            $sensitiveResult = new SensitiveResult();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $sensitiveResult->setId($data['id']);
        }
        if (isset($attributes['titleContains'])) {
            $sensitiveResult->setTitleContains($attributes['titleContains']);
        }
        if (isset($attributes['descriptionContains'])) {
            $sensitiveResult->setDescriptionContains($attributes['descriptionContains']);
        }
        if (isset($attributes['contentContains'])) {
            $sensitiveResult->setContentContains($attributes['contentContains']);
        }
        if (isset($attributes['status'])) {
            $sensitiveResult->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $sensitiveResult->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $sensitiveResult->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $sensitiveResult->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['article'])) {
            $articleArray = $this->relationshipFill($relationships['article'], $included);
            $article = $this->getArticleRestfulTranslator()->arrayToObject($articleArray);
            $sensitiveResult->setArticle($article);
        }
        
        return $sensitiveResult;
    }

    public function objectToArray($sensitiveResult, array $keys = array())
    {
        unset($sensitiveResult);
        unset($keys);

        return array();
    }
}

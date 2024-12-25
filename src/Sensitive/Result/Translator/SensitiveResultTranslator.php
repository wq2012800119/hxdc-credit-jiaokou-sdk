<?php
namespace Sdk\Sensitive\Result\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Marmot\Framework\Classes\Filter;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Sensitive\Result\Model\SensitiveResult;
use Sdk\Sensitive\Result\Model\NullSensitiveResult;

use Sdk\Article\Article\Translator\ArticleTranslator;

class SensitiveResultTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getArticleTranslator() : ArticleTranslator
    {
        return new ArticleTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullSensitiveResult::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($sensitiveResult, array $keys = array())
    {
        if (!$sensitiveResult instanceof SensitiveResult) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'titleContains',
                'descriptionContains',
                'contentContains',
                'article' => ['id', 'title'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($sensitiveResult->getId());
        }
        if (in_array('titleContains', $keys)) {
            $expression['titleContains'] = $sensitiveResult->getTitleContains();
        }
        if (in_array('descriptionContains', $keys)) {
            $expression['descriptionContains'] = $sensitiveResult->getDescriptionContains();
        }
        if (in_array('contentContains', $keys)) {
            $expression['contentContains'] = Filter::dhtmlspecialchars($sensitiveResult->getContentContains());
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $sensitiveResult->getStatus();
        }
        if (isset($keys['article'])) {
            $expression['article'] = $this->getArticleTranslator()->objectToArray(
                $sensitiveResult->getArticle(),
                $keys['article']
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $sensitiveResult->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveResult->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $sensitiveResult->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveResult->getUpdateTime());
        }

        return $expression;
    }
}

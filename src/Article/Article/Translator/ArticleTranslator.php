<?php
namespace Sdk\Article\Article\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Marmot\Framework\Classes\Filter;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\ITopAble;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Article\Model\NullArticle;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Article\Category\Translator\CategoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ArticleTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getCategoryTranslator() : CategoryTranslator
    {
        return new CategoryTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullArticle::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($article, array $keys = array())
    {
        if (!$article instanceof Article) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'title',
                'source',
                'pubDate',
                'description',
                'cover',
                'attachments',
                'content',
                'isSlides',
                'isHomeSlides',
                'slidesPicture',
                'category' => ['id', 'name', 'parentCategory'],
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'topStatus',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($article->getId());
        }
        if (in_array('title', $keys)) {
            $expression['title'] = $article->getTitle();
        }
        if (in_array('source', $keys)) {
            $expression['source'] = $article->getSource();
        }
        if (in_array('pubDate', $keys)) {
            $expression['pubDate'] = $article->getPubDate();
            $expression['pubDateFormatConvert'] = date('Y-m-d', $article->getPubDate());
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $article->getDescription();
        }
        if (in_array('cover', $keys)) {
            $expression['cover'] = $article->getCover();
        }
        if (in_array('attachments', $keys)) {
            $expression['attachments'] = $article->getAttachments();
        }
        if (in_array('content', $keys)) {
            $expression['content'] = Filter::dhtmlspecialchars($article->getContent());
        }
        if (in_array('slidesPicture', $keys)) {
            $expression['slidesPicture'] = $article->getSlidesPicture();
        }

        $expression = $this->typeObjectToArray($article, $keys, $expression);
        $expression = $this->relationObjectToArray($article, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $article->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $article->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $article->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $article->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Article $article, array $keys, array $expression) : array
    {
        if (in_array('isSlides', $keys)) {
            $expression['isSlides'] = $this->typeFormatConversion(
                $article->getIsSlides(),
                Article::IS_SLIDES_CN
            );
        }
        if (in_array('isHomeSlides', $keys)) {
            $expression['isHomeSlides'] = $this->typeFormatConversion(
                $article->getIsHomeSlides(),
                Article::IS_HOME_SLIDES_CN
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $article->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('topStatus', $keys)) {
            $expression['topStatus'] = $this->statusFormatConversion(
                $article->getTopStatus(),
                ITopAble::TOP_STATUS_TYPE,
                ITopAble::TOP_STATUS_CN
            );
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $article->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }

        return $expression;
    }

    protected function relationObjectToArray(Article $article, array $keys, array $expression) : array
    {
        if (isset($keys['category'])) {
            $expression['category'] = $this->getCategoryTranslator()->objectToArray(
                $article->getCategory(),
                $keys['category']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $article->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $article->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\Article\Article\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Article\Model\NullArticle;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Article\Category\Translator\CategoryRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class ArticleRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getCategoryRestfulTranslator() : CategoryRestfulTranslator
    {
        return new CategoryRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $article = null)
    {
        if (empty($expression)) {
            return NullArticle::getInstance();
        }

        if ($article == null) {
            $article = new Article();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $article->setId($data['id']);
        }
        if (isset($attributes['title'])) {
            $article->setTitle($attributes['title']);
        }
        if (isset($attributes['source'])) {
            $article->setSource($attributes['source']);
        }
        if (isset($attributes['pubDate'])) {
            $article->setPubDate($attributes['pubDate']);
        }
        if (isset($attributes['description'])) {
            $article->setDescription($attributes['description']);
        }
        if (isset($attributes['cover'])) {
            $article->setCover($attributes['cover']);
        }
        if (isset($attributes['attachments'])) {
            $article->setAttachments($attributes['attachments']);
        }
        if (isset($attributes['content'])) {
            $article->setContent($attributes['content']);
        }
        if (isset($attributes['isSlides'])) {
            $article->setIsSlides($attributes['isSlides']);
        }
        if (isset($attributes['isHomeSlides'])) {
            $article->setIsHomeSlides($attributes['isHomeSlides']);
        }
        if (isset($attributes['slidesPicture'])) {
            $article->setSlidesPicture($attributes['slidesPicture']);
        }
        if (isset($attributes['topStatus'])) {
            $article->setTopStatus($attributes['topStatus']);
        }
        if (isset($attributes['examineStatus'])) {
            $article->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $article->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $article->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $article->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $article->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['category'])) {
            $categoryArray = $this->relationshipFill($relationships['category'], $included);
            $category = $this->getCategoryRestfulTranslator()->arrayToObject($categoryArray);
            $article->setCategory($category);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $article->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $article->setStaff($staff);
        }

        return $article;
    }

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
                'category',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'articles'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $article->getId();
        }

        $attributes = array();

        if (in_array('title', $keys)) {
            $attributes['title'] = $article->getTitle();
        }
        if (in_array('source', $keys)) {
            $attributes['source'] = $article->getSource();
        }
        if (in_array('pubDate', $keys)) {
            $attributes['pubDate'] = $article->getPubDate();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $article->getDescription();
        }
        if (in_array('cover', $keys)) {
            $attributes['cover'] = !empty($article->getCover()) ? $article->getCover() : new \ArrayObject;
        }
        if (in_array('content', $keys)) {
            $attributes['content'] = $article->getContent();
        }
        if (in_array('attachments', $keys)) {
            $attributes['attachments'] = $article->getAttachments();
        }
        if (in_array('isSlides', $keys)) {
            $attributes['isSlides'] = $article->getIsSlides();
        }
        if (in_array('isHomeSlides', $keys)) {
            $attributes['isHomeSlides'] = $article->getIsHomeSlides();
        }
        if (in_array('slidesPicture', $keys)) {
            $attributes['slidesPicture'] = !empty($article->getSlidesPicture()) ?
                                            $article->getSlidesPicture() :
                                            new \ArrayObject;
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('category', $keys)) {
            $expression['data']['relationships']['category']['data'] = array(
                'type' => 'articleCategories',
                'id' => strval($article->getCategory()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($article->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}

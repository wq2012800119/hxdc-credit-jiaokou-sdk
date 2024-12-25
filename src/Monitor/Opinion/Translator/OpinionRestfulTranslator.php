<?php
namespace Sdk\Monitor\Opinion\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Monitor\Opinion\Model\Opinion;
use Sdk\Monitor\Opinion\Model\NullOpinion;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class OpinionRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $opinion = null)
    {
        if (empty($expression)) {
            return NullOpinion::getInstance();
        }

        if ($opinion == null) {
            $opinion = new Opinion();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $opinion->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $opinion->setName($attributes['name']);
        }
        if (isset($attributes['keyword'])) {
            $opinion->setKeyword($attributes['keyword']);
        }
        if (isset($attributes['category'])) {
            $opinion->setCategory($attributes['category']);
        }
        if (isset($attributes['source'])) {
            $opinion->setSource($attributes['source']);
        }
        if (isset($attributes['pubDate'])) {
            $opinion->setPubDate($attributes['pubDate']);
        }
        if (isset($attributes['content'])) {
            $opinion->setContent($attributes['content']);
        }
        if (isset($attributes['status'])) {
            $opinion->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $opinion->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $opinion->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $opinion->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $opinion->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $opinion->setStaff($staff);
        }
        
        return $opinion;
    }

    public function objectToArray($opinion, array $keys = array())
    {
        if (!$opinion instanceof Opinion) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'keyword',
                'category',
                'source',
                'pubDate',
                'content',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'opinions'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $opinion->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $opinion->getName();
        }
        if (in_array('keyword', $keys)) {
            $attributes['keyword'] = $opinion->getKeyword();
        }
        if (in_array('category', $keys)) {
            $attributes['category'] = $opinion->getCategory();
        }
        if (in_array('source', $keys)) {
            $attributes['source'] = $opinion->getSource();
        }
        if (in_array('pubDate', $keys)) {
            $attributes['pubDate'] = $opinion->getPubDate();
        }
        if (in_array('content', $keys)) {
            $attributes['content'] = $opinion->getContent();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($opinion->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}

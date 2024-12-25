<?php
namespace Sdk\Evaluation\Indicator\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Evaluation\Indicator\Model\Indicator;
use Sdk\Evaluation\Indicator\Model\NullIndicator;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class IndicatorRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $indicator = null)
    {
        if (empty($expression)) {
            return NullIndicator::getInstance();
        }

        if ($indicator == null) {
            $indicator = new Indicator();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $indicator->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $indicator->setName($attributes['name']);
        }
        if (isset($attributes['infoCategory'])) {
            $indicator->setInfoCategory($attributes['infoCategory']);
        }
        if (isset($attributes['description'])) {
            $indicator->setDescription($attributes['description']);
        }
        if (isset($attributes['category'])) {
            $indicator->setCategory($attributes['category']);
        }
        if (isset($attributes['sourceId'])) {
            $indicator->setSourceId($attributes['sourceId']);
        }
        if (isset($attributes['sourceName'])) {
            $indicator->setSourceName($attributes['sourceName']);
        }
        if (isset($attributes['sourceSubjectCategory'])) {
            $subjectCategory = $this->subjectCategorySplit($attributes['sourceSubjectCategory']);
            $indicator->setSourceSubjectCategory($subjectCategory);
        }
        if (isset($attributes['status'])) {
            $indicator->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $indicator->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $indicator->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $indicator->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $indicator->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $indicator->setStaff($staff);
        }
        
        return $indicator;
    }

    protected function subjectCategorySplit(int $subjectCategory) : array
    {
        $subjectCategoryArray = array();

        foreach (Indicator::SOURCE_SUBJECT_CATEGORY as $value) {
            if (($value & $subjectCategory) == $value) {
                $subjectCategoryArray[] = $value;
            }
        }

        return $subjectCategoryArray;
    }

    public function objectToArray($indicator, array $keys = array())
    {
        if (!$indicator instanceof Indicator) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'infoCategory',
                'description',
                'category',
                'sourceId',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'indicators'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $indicator->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $indicator->getName();
        }
        if (in_array('infoCategory', $keys)) {
            $attributes['infoCategory'] = $indicator->getInfoCategory();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $indicator->getDescription();
        }
        if (in_array('category', $keys)) {
            $attributes['category'] = $indicator->getCategory();
        }
        if (in_array('sourceId', $keys)) {
            $attributes['sourceId'] = $indicator->getSourceId();
        }
        
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($indicator->getStaff()->getId())
            );
        }

        return $expression;
    }
}

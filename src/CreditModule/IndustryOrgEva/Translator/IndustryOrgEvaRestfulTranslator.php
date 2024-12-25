<?php
namespace Sdk\CreditModule\IndustryOrgEva\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditModule\IndustryOrgEva\Model\IndustryOrgEva;
use Sdk\CreditModule\IndustryOrgEva\Model\NullIndustryOrgEva;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class IndustryOrgEvaRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $industryOrgEva = null)
    {
        if (empty($expression)) {
            return NullIndustryOrgEva::getInstance();
        }

        if ($industryOrgEva == null) {
            $industryOrgEva = new IndustryOrgEva();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $industryOrgEva->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $industryOrgEva->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $industryOrgEva->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['industryName'])) {
            $industryOrgEva->setIndustryName($attributes['industryName']);
        }
        if (isset($attributes['evaluationType'])) {
            $industryOrgEva->setEvaluationType($attributes['evaluationType']);
        }
        if (isset($attributes['evaluationContent'])) {
            $industryOrgEva->setEvaluationContent($attributes['evaluationContent']);
        }
        if (isset($attributes['status'])) {
            $industryOrgEva->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $industryOrgEva->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $industryOrgEva->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $industryOrgEva->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $industryOrgEva->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $industryOrgEva->setStaff($staff);
        }
        
        return $industryOrgEva;
    }

    public function objectToArray($industryOrgEva, array $keys = array())
    {
        if (!$industryOrgEva instanceof IndustryOrgEva) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'unifiedIdentifier',
                'industryName',
                'evaluationType',
                'evaluationContent',
                'organization',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'industryOrganizationEvaluations'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $industryOrgEva->getId();
        }

        $attributes = array();

        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $industryOrgEva->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $industryOrgEva->getUnifiedIdentifier();
        }
        if (in_array('industryName', $keys)) {
            $attributes['industryName'] = $industryOrgEva->getIndustryName();
        }
        if (in_array('evaluationType', $keys)) {
            $attributes['evaluationType'] = $industryOrgEva->getEvaluationType();
        }
        if (in_array('evaluationContent', $keys)) {
            $attributes['evaluationContent'] = $industryOrgEva->getEvaluationContent();
        }
        
        $expression['data']['attributes'] = $attributes;
        
        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organization',
                'id' => strval($industryOrgEva->getOrganization()->getId())
            );
        }

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($industryOrgEva->getStaff()->getId())
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\CreditModule\IndustryOrgEva\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditModule\IndustryOrgEva\Model\IndustryOrgEva;
use Sdk\CreditModule\IndustryOrgEva\Model\NullIndustryOrgEva;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class IndustryOrgEvaTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullIndustryOrgEva::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($industryOrgEva->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $industryOrgEva->getSubjectName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $industryOrgEva->getUnifiedIdentifier();
        }
        if (in_array('industryName', $keys)) {
            $expression['industryName'] = $industryOrgEva->getIndustryName();
        }
        if (in_array('evaluationType', $keys)) {
            $expression['evaluationType'] = $industryOrgEva->getEvaluationType();
        }
        if (in_array('evaluationContent', $keys)) {
            $expression['evaluationContent'] = $industryOrgEva->getEvaluationContent();
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $industryOrgEva->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($industryOrgEva, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $industryOrgEva->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $industryOrgEva->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $industryOrgEva->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $industryOrgEva->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(IndustryOrgEva $industryOrgEva, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $industryOrgEva->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $industryOrgEva->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

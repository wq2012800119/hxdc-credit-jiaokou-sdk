<?php
namespace Sdk\Evaluation\Indicator\Translator;

use IntlChar;
use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Evaluation\Indicator\Model\Indicator;
use Sdk\Evaluation\Indicator\Model\NullIndicator;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class IndicatorTranslator implements ITranslator
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
        return NullIndicator::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
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
                'sourceName',
                'sourceSubjectCategory',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($indicator->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $indicator->getName();
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $indicator->getDescription();
        }
        if (in_array('sourceId', $keys)) {
            $expression['sourceId'] = marmot_encode($indicator->getSourceId());
        }
        if (in_array('sourceName', $keys)) {
            $expression['sourceName'] = $indicator->getSourceName();
        }
        if (in_array('infoCategory', $keys)) {
            $expression['infoCategory'] = $this->typeFormatConversion(
                $indicator->getInfoCategory(),
                Indicator::INFO_CATEGORY_CN
            );
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $this->typeFormatConversion(
                $indicator->getCategory(),
                Indicator::CATEGORY_CN
            );
        }
        if (in_array('sourceSubjectCategory', $keys)) {
            $expression['sourceSubjectCategory'] = $this->subjectCategoryFormatConversion(
                $indicator->getSourceSubjectCategory()
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $indicator->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($indicator, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $indicator->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $indicator->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $indicator->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $indicator->getUpdateTime());
        }

        return $expression;
    }

    protected function subjectCategoryFormatConversion($subjectCategory)
    {
        $categoryFormatConversion = array();
        foreach ($subjectCategory as $id) {
            $categoryFormatConversion[] = $this->typeFormatConversion($id, Indicator::SOURCE_SUBJECT_CATEGORY_CN);
        }

        return $categoryFormatConversion;
    }

    protected function relationObjectToArray(Indicator $indicator, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $indicator->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $indicator->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

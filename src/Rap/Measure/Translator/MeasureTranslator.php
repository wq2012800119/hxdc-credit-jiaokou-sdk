<?php
namespace Sdk\Rap\Measure\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Rap\Measure\Model\Measure;
use Sdk\Rap\Measure\Model\NullMeasure;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Rap\Memorandum\Translator\MemorandumTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class MeasureTranslator implements ITranslator
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

    protected function getMemorandumTranslator() : MemorandumTranslator
    {
        return new MemorandumTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullMeasure::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($measure, array $keys = array())
    {
        if (!$measure instanceof Measure) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'description',
                'rewardType',
                'implementationUnits' => ['id', 'name'],
                'organization' => ['id', 'name'],
                'memorandum' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($measure->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $measure->getName();
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $measure->getDescription();
        }
        if (in_array('rewardType', $keys)) {
            $expression['rewardType'] = $this->typeFormatConversion(
                $measure->getRewardType(),
                Measure::REWARD_TYPE_CN
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $measure->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($measure, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $measure->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $measure->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $measure->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $measure->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(Measure $measure, array $keys, array $expression) : array
    {
        if (isset($keys['implementationUnits'])) {
            $expression['implementationUnits'] = array();
            foreach ($measure->getImplementationUnits() as $implementationUnit) {
                $expression['implementationUnits'][] = $this->getOrganizationTranslator()->objectToArray(
                    $implementationUnit,
                    $keys['implementationUnits']
                );
            }
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $measure->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['memorandum'])) {
            $expression['memorandum'] = $this->getMemorandumTranslator()->objectToArray(
                $measure->getMemorandum(),
                $keys['memorandum']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $measure->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

<?php
namespace Sdk\Monitor\FocusMonitor\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitor;
use Sdk\Monitor\FocusMonitor\Model\NullFocusMonitor;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class FocusMonitorTranslator implements ITranslator
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
        return NullFocusMonitor::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($focusMonitor, array $keys = array())
    {
        if (!$focusMonitor instanceof FocusMonitor) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'identify',
                'subjectCategory',
                'penaltyThreshold',
                'dishonestyThreshold',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($focusMonitor->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $focusMonitor->getName();
        }
        if (in_array('identify', $keys)) {
            $expression['identify'] = $focusMonitor->getIdentify();
        }
        if (in_array('subjectCategory', $keys)) {
            $expression['subjectCategory'] = $this->typeFormatConversion(
                $focusMonitor->getSubjectCategory(),
                FocusMonitor::SUBJECT_CATEGORY_CN
            );
        }
        if (in_array('penaltyThreshold', $keys)) {
            $expression['penaltyThreshold'] = $focusMonitor->getPenaltyThreshold();
        }
        if (in_array('dishonestyThreshold', $keys)) {
            $expression['dishonestyThreshold'] = $focusMonitor->getDishonestyThreshold();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $focusMonitor->getStatus(),
                IOperateAble::STATUS_TYPE,
                IOperateAble::STATUS_CN
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $focusMonitor->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $focusMonitor->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $focusMonitor->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $focusMonitor->getUpdateTime());
        }

        $expression = $this->relationObjectToArray($focusMonitor, $keys, $expression);

        return $expression;
    }

    protected function relationObjectToArray(FocusMonitor $focusMonitor, array $keys, array $expression) : array
    {
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $focusMonitor->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $focusMonitor->getOrganization(),
                $keys['organization']
            );
        }

        return $expression;
    }
}

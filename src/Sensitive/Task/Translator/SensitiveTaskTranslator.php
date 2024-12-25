<?php
namespace Sdk\Sensitive\Task\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Sensitive\Task\Model\SensitiveTask;
use Sdk\Sensitive\Task\Model\NullSensitiveTask;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class SensitiveTaskTranslator implements ITranslator
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
        return NullSensitiveTask::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($sensitiveTask, array $keys = array())
    {
        if (!$sensitiveTask instanceof SensitiveTask) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'updatedNum',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($sensitiveTask->getId());
        }
        if (in_array('updatedNum', $keys)) {
            $expression['updatedNum'] = $sensitiveTask->getUpdatedNum();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $sensitiveTask->getStatus(),
                SensitiveTask::STATUS_TYPE,
                SensitiveTask::STATUS_CN
            );
        }

        $expression = $this->relationObjectToArray($sensitiveTask, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $sensitiveTask->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveTask->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $sensitiveTask->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $sensitiveTask->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(SensitiveTask $sensitiveTask, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $sensitiveTask->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $sensitiveTask->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

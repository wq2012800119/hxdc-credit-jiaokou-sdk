<?php
namespace Sdk\Application\UploadDataTask\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;
use Sdk\Application\UploadDataTask\Model\NullUploadDataTask;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class UploadDataTaskTranslator implements ITranslator
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
        return NullUploadDataTask::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($uploadDataTask, array $keys = array())
    {
        if (!$uploadDataTask instanceof UploadDataTask) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'exportFileName',
                'total',
                'successNum',
                'failNum',
                'updatedNum',
                'degreeOfCompletion',
                'executionStatus',
                'code',
                'category',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($uploadDataTask->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $uploadDataTask->getName();
        }
        if (in_array('exportFileName', $keys)) {
            $expression['exportFileName'] = $uploadDataTask->getExportFileName();
        }
        if (in_array('degreeOfCompletion', $keys)) {
            $total = $uploadDataTask->getTotal();
            $updatedNum = $uploadDataTask->getUpdatedNum();
            $degreeOfCompletion = empty($total) ? 100 : number_format($updatedNum/$total, 2)*100;
            $expression['degreeOfCompletion'] = $degreeOfCompletion;
        }
        if (in_array('total', $keys)) {
            $expression['total'] = $uploadDataTask->getTotal();
        }
        if (in_array('successNum', $keys)) {
            $expression['successNum'] = $uploadDataTask->getSuccessNum();
        }
        if (in_array('failNum', $keys)) {
            $total = $uploadDataTask->getTotal();
            $successNum = $uploadDataTask->getSuccessNum();
            $expression['failNum'] = $total - $successNum;
        }
        if (in_array('updatedNum', $keys)) {
            $expression['updatedNum'] = $uploadDataTask->getUpdatedNum();
        }
        if (in_array('executionStatus', $keys)) {
            $expression['executionStatus'] = $this->statusFormatConversion(
                $uploadDataTask->getExecutionStatus(),
                UploadDataTask::EXECUTION_STATUS_TYPE,
                UploadDataTask::EXECUTION_STATUS_CN
            );
        }
        if (in_array('code', $keys)) {
            $expression['code'] = $this->typeFormatConversion(
                $uploadDataTask->getCode(),
                UploadDataTask::CODE_CN
            );
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $this->typeFormatConversion(
                $uploadDataTask->getCategory(),
                UploadDataTask::CATEGORY_CN
            );
        }
        
        $expression = $this->relationObjectToArray($uploadDataTask, $keys, $expression);
        
        if (in_array('status', $keys)) {
            $expression['status'] = $this->taskStatusFormatConversion($uploadDataTask);
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $uploadDataTask->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $uploadDataTask->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $uploadDataTask->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $uploadDataTask->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(UploadDataTask $uploadDataTask, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $uploadDataTask->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $uploadDataTask->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }

    protected function taskStatusFormatConversion($uploadDataTask) : array
    {
        $statusFormatConversion = array();
        $total = $uploadDataTask->getTotal();
        $successNum = $uploadDataTask->getSuccessNum();
        $status = UploadDataTask::TASK_STATUS['NULL'];
        $executionStatus = $uploadDataTask->getExecutionStatus();
        
        if ($executionStatus == UploadDataTask::EXECUTION_STATUS['FAILED']) {
            $status = UploadDataTask::TASK_STATUS['FAILED'];
        }

        if ($executionStatus == UploadDataTask::EXECUTION_STATUS['COMPLETED']) {
            if ($total != $successNum) {
                $status = UploadDataTask::TASK_STATUS['FAILED'];
            }
            if ($total == $successNum) {
                $status = UploadDataTask::TASK_STATUS['SUCCESS'];
            }
        }

        $statusFormatConversion = $this->statusFormatConversion(
            $status,
            UploadDataTask::TASK_STATUS_TYPE,
            UploadDataTask::TASK_STATUS_CN
        );

        return $statusFormatConversion;
    }
}

<?php
namespace Sdk\Resource\ExportDataTask\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Resource\ExportDataTask\Model\ExportDataTask;
use Sdk\Resource\ExportDataTask\Model\NullExportDataTask;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Resource\Directory\Translator\DirectoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class ExportDataTaskTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getStaffTranslator() : StaffTranslator
    {
        return new StaffTranslator();
    }

    protected function getSnapshotTranslator() : SnapshotTranslator
    {
        return new SnapshotTranslator();
    }

    protected function getDirectoryTranslator() : DirectoryTranslator
    {
        return new DirectoryTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullExportDataTask::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($exportDataTask, array $keys = array())
    {
        if (!$exportDataTask instanceof ExportDataTask) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'exportFileName',
                'total',
                'size',
                'offset',
                'filter',
                'sort',
                'updatedNum',
                'degreeOfCompletion',
                'code',
                'organization' => ['id', 'name'],
                'directory' => ['id', 'name', 'items'],
                'directorySnapshot' => ['id', 'name', 'items'],
                'staff' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($exportDataTask->getId());
        }
        if (in_array('exportFileName', $keys)) {
            $expression['exportFileName'] = $exportDataTask->getExportFileName();
        }
        if (in_array('total', $keys)) {
            $expression['total'] = $exportDataTask->getTotal();
        }
        if (in_array('size', $keys)) {
            $expression['size'] = $exportDataTask->getSize();
        }
        if (in_array('offset', $keys)) {
            $expression['offset'] = $exportDataTask->getOffset();
        }
        if (in_array('filter', $keys)) {
            $expression['filter'] = $exportDataTask->getFilter();
        }
        if (in_array('sort', $keys)) {
            $expression['sort'] = $exportDataTask->getSort();
        }
        if (in_array('updatedNum', $keys)) {
            $expression['updatedNum'] = $exportDataTask->getUpdatedNum();
        }
        if (in_array('degreeOfCompletion', $keys)) {
            $total = $exportDataTask->getTotal();
            $updatedNum = $exportDataTask->getUpdatedNum();
            $expression['degreeOfCompletion'] = 0;
            if (!empty($total) && !empty($updatedNum)) {
                $expression['degreeOfCompletion'] = number_format($updatedNum/$total, 2)*100;
            }
        }
        if (in_array('code', $keys)) {
            $expression['code'] = $this->typeFormatConversion(
                $exportDataTask->getCode(),
                ExportDataTask::CODE_CN
            );
        }
        
        $expression = $this->relationObjectToArray($exportDataTask, $keys, $expression);
    
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $exportDataTask->getStatus(),
                ExportDataTask::TASK_STATUS_TYPE,
                ExportDataTask::TASK_STATUS_CN
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $exportDataTask->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $exportDataTask->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $exportDataTask->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $exportDataTask->getUpdateTime());
        }

        return $expression;
    }

    protected function relationObjectToArray(ExportDataTask $exportDataTask, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $exportDataTask->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['directory'])) {
            $expression['directory'] = $this->getDirectoryTranslator()->objectToArray(
                $exportDataTask->getDirectory(),
                $keys['directory']
            );
        }
        if (isset($keys['directorySnapshot'])) {
            $expression['directorySnapshot'] = $this->getSnapshotTranslator()->objectToArray(
                $exportDataTask->getDirectorySnapshot(),
                $keys['directorySnapshot']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $exportDataTask->getStaff(),
                $keys['staff']
            );
        }

        return $expression;
    }
}

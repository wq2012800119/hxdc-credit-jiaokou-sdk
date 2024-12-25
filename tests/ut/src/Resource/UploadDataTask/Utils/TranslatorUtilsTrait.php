<?php
namespace Sdk\Resource\UploadDataTask\Utils;

use Sdk\Resource\UploadDataTask\Model\UploadDataTask;
use Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(UploadDataTask $uploadDataTask, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $uploadDataTask->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $uploadDataTask->getName());
        }
        if (isset($attributes['exportFileName'])) {
            $this->assertEquals($attributes['exportFileName'], $uploadDataTask->getExportFileName());
        }
        if (isset($attributes['total'])) {
            $this->assertEquals($attributes['total'], $uploadDataTask->getTotal());
        }
        if (isset($attributes['successNum'])) {
            $this->assertEquals($attributes['successNum'], $uploadDataTask->getSuccessNum());
        }
        if (isset($attributes['updatedNum'])) {
            $this->assertEquals($attributes['updatedNum'], $uploadDataTask->getUpdatedNum());
        }
        if (isset($attributes['code'])) {
            $this->assertEquals($attributes['code'], $uploadDataTask->getCode());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $uploadDataTask->getExecutionStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $uploadDataTask->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $uploadDataTask->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $uploadDataTask->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();

        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $uploadDataTask->getStaff()->getId());
        }

        if (isset($relationships['organization']['data'])) {
            $organization = $relationships['organization']['data'];
            $this->assertEquals($organization['type'], 'organizations');
            $this->assertEquals($organization['id'], $uploadDataTask->getOrganization()->getId());
        }

        if (isset($relationships['directorySnapshot']['data'])) {
            $directorySnapshot = $relationships['directorySnapshot']['data'];
            $this->assertEquals($directorySnapshot['type'], 'directorySnapshots');
            $this->assertEquals($directorySnapshot['id'], $uploadDataTask->getDirectorySnapshot()->getId());
        }

        if (isset($relationships['directory']['data'])) {
            $directory = $relationships['directory']['data'];
            $this->assertEquals($directory['type'], 'directories');
            $this->assertEquals($directory['id'], $uploadDataTask->getDirectory()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, UploadDataTask $uploadDataTask)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($uploadDataTask->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $uploadDataTask->getName());
        }
        if (isset($expression['exportFileName'])) {
            $this->assertEquals($expression['exportFileName'], $uploadDataTask->getExportFileName());
        }
        if (isset($expression['total'])) {
            $this->assertEquals($expression['total'], $uploadDataTask->getTotal());
        }
        if (isset($expression['successNum'])) {
            $this->assertEquals($expression['successNum'], $uploadDataTask->getSuccessNum());
        }
        if (isset($expression['failNum'])) {
            $failNum = $uploadDataTask->getTotal() - $uploadDataTask->getSuccessNum();
            $this->assertEquals($expression['failNum'], $failNum);
        }
        if (isset($expression['updatedNum'])) {
            $this->assertEquals($expression['updatedNum'], $uploadDataTask->getUpdatedNum());
        }
        if (isset($expression['degreeOfCompletion'])) {
            $total = $uploadDataTask->getTotal();
            $updatedNum = $uploadDataTask->getUpdatedNum();
            $degreeOfCompletion = number_format($updatedNum/$total, 2)*100;

            $this->assertEquals($expression['degreeOfCompletion'], $degreeOfCompletion);
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $uploadDataTask->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $uploadDataTask->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $uploadDataTask->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $uploadDataTask->getUpdateTime())
            );
        }
    }

    public function compareRecordRestfulTranslatorEquals(UploadDataTaskRecord $record, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $record->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['index'])) {
            $this->assertEquals($attributes['index'], $record->getIndex());
        }
        if (isset($attributes['items'])) {
            $this->assertEquals($attributes['items'], $record->getItems());
        }
        if (isset($attributes['errorDescription'])) {
            $this->assertEquals($attributes['errorDescription'], $record->getErrorDescription());
        }
        if (isset($attributes['failReason'])) {
            $this->assertEquals($attributes['failReason'], $record->getFailReason());
        }
        if (isset($attributes['errorNumber'])) {
            $this->assertEquals($attributes['errorNumber'], $record->getErrorNumber());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $record->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $record->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $record->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $record->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();

        if (isset($relationships['task']['data'])) {
            $task = $relationships['task']['data'];
            $this->assertEquals($task['type'], 'uploadDataTasks');
            $this->assertEquals($task['id'], $record->getUploadDataTask()->getId());
        }
    }

    public function compareRecordTranslatorEquals(array $expression, UploadDataTaskRecord $record)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($record->getId()));
        }
        if (isset($expression['index'])) {
            $this->assertEquals($expression['index'], $record->getIndex());
        }
        if (isset($expression['items'])) {
            $this->assertEquals($expression['items'], $record->getItems());
        }
        if (isset($expression['errorDescription'])) {
            $this->assertEquals($expression['errorDescription'], $record->getErrorDescription());
        }
        if (isset($expression['failReason'])) {
            $this->assertEquals($expression['failReason'], $record->getFailReason());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $record->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $record->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $record->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $record->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $record->getUpdateTime())
            );
        }
    }
}

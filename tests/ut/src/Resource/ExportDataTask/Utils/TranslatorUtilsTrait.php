<?php
namespace Sdk\Resource\ExportDataTask\Utils;

use Sdk\Resource\ExportDataTask\Model\ExportDataTask;
use Sdk\Resource\ExportDataTask\Model\ExportDataTaskRecord;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(ExportDataTask $exportDataTask, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $exportDataTask->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $exportDataTask->getExportFileName());
        }
        if (isset($attributes['total'])) {
            $this->assertEquals($attributes['total'], $exportDataTask->getTotal());
        }
        if (isset($attributes['size'])) {
            $this->assertEquals($attributes['size'], $exportDataTask->getSize());
        }
        if (isset($attributes['offset'])) {
            $this->assertEquals($attributes['offset'], $exportDataTask->getOffset());
        }
        if (isset($attributes['filter'])) {
            $this->assertEquals($attributes['filter'], $exportDataTask->getFilter());
        }
        if (isset($attributes['sort'])) {
            $this->assertEquals($attributes['sort'], $exportDataTask->getSort());
        }
        if (isset($attributes['updatedNum'])) {
            $this->assertEquals($attributes['updatedNum'], $exportDataTask->getUpdatedNum());
        }
        if (isset($attributes['code'])) {
            $this->assertEquals($attributes['code'], $exportDataTask->getCode());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $exportDataTask->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $exportDataTask->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $exportDataTask->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $exportDataTask->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();

        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $exportDataTask->getStaff()->getId());
        }

        if (isset($relationships['organization']['data'])) {
            $organization = $relationships['organization']['data'];
            $this->assertEquals($organization['type'], 'organizations');
            $this->assertEquals($organization['id'], $exportDataTask->getOrganization()->getId());
        }

        if (isset($relationships['directorySnapshot']['data'])) {
            $directorySnapshot = $relationships['directorySnapshot']['data'];
            $this->assertEquals($directorySnapshot['type'], 'directorySnapshots');
            $this->assertEquals($directorySnapshot['id'], $exportDataTask->getDirectorySnapshot()->getId());
        }

        if (isset($relationships['directory']['data'])) {
            $directory = $relationships['directory']['data'];
            $this->assertEquals($directory['type'], 'directories');
            $this->assertEquals($directory['id'], $exportDataTask->getDirectory()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, ExportDataTask $exportDataTask)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($exportDataTask->getId()));
        }
        if (isset($expression['exportFileName'])) {
            $this->assertEquals($expression['exportFileName'], $exportDataTask->getExportFileName());
        }
        if (isset($expression['total'])) {
            $this->assertEquals($expression['total'], $exportDataTask->getTotal());
        }
        if (isset($expression['size'])) {
            $this->assertEquals($expression['size'], $exportDataTask->getSize());
        }
        if (isset($expression['offset'])) {
            $this->assertEquals($expression['offset'], $exportDataTask->getOffset());
        }
        if (isset($expression['filter'])) {
            $this->assertEquals($expression['filter'], $exportDataTask->getFilter());
        }
        if (isset($expression['sort'])) {
            $this->assertEquals($expression['sort'], $exportDataTask->getSort());
        }
        if (isset($expression['updatedNum'])) {
            $this->assertEquals($expression['updatedNum'], $exportDataTask->getUpdatedNum());
        }
        if (isset($expression['degreeOfCompletion'])) {
            $total = $exportDataTask->getTotal();
            $updatedNum = $exportDataTask->getUpdatedNum();
            $degreeOfCompletion = 0;
            if (!empty($total) && !empty($updatedNum)) {
                $degreeOfCompletion = number_format($updatedNum/$total, 2)*100;
            }

            $this->assertEquals($expression['degreeOfCompletion'], $degreeOfCompletion);
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $exportDataTask->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $exportDataTask->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $exportDataTask->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $exportDataTask->getUpdateTime())
            );
        }
    }
}

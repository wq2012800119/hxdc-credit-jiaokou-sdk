<?php
namespace Sdk\Resource\Data\Utils;

use Sdk\Resource\Data\Model\Data;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Data $data, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $data->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['subjectName'])) {
            $this->assertEquals($attributes['subjectName'], $data->getSubjectName());
        }
        if (isset($attributes['identify'])) {
            $this->assertEquals($attributes['identify'], $data->getIdentify());
        }
        if (isset($attributes['subjectCategory'])) {
            $this->assertEquals($attributes['subjectCategory'], $data->getSubjectCategory());
        }
        if (isset($attributes['infoCategory'])) {
            $this->assertEquals($attributes['infoCategory'], $data->getInfoCategory());
        }
        if (isset($attributes['publicationRange'])) {
            $this->assertEquals($attributes['publicationRange'], $data->getPublicationRange());
        }
        if (isset($attributes['expireDate'])) {
            $this->assertEquals($attributes['expireDate'], $data->getExpireDate());
        }
        if (isset($attributes['exchangeSyncStatus'])) {
            $this->assertEquals($attributes['exchangeSyncStatus'], $data->getExchangeSyncStatus());
        }
        if (isset($attributes['internalSyncStatus'])) {
            $this->assertEquals($attributes['internalSyncStatus'], $data->getInternalSyncStatus());
        }
        if (isset($attributes['items'])) {
            $this->assertEquals($attributes['items'], $data->getItems());
        }
        if (isset($attributes['examineStatus'])) {
            $this->assertEquals($attributes['examineStatus'], $data->getExamineStatus());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $data->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $data->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $data->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $data->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $data->getStaff()->getId());
        }
        if (isset($relationships['directory']['data'])) {
            $directory = $relationships['directory']['data'];
            $this->assertEquals($directory['type'], 'directories');
            $this->assertEquals($directory['id'], $data->getDirectory()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Data $data)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($data->getId()));
        }
        if (isset($expression['subjectName'])) {
            $this->assertEquals($expression['subjectName'], $data->getSubjectName());
        }
        if (isset($expression['identify'])) {
            $this->assertEquals($expression['identify'], $data->getIdentify());
        }
        if (isset($expression['expireDate'])) {
            $this->assertEquals($expression['expireDate'], $data->getExpireDate());
            $this->assertEquals(
                $expression['expireDateFormatConvert'],
                date('Y-m-d', $data->getExpireDate())
            );
        }
        if (isset($expression['items'])) {
            $this->assertEquals($expression['items'], $data->getItems());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $data->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $data->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $data->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $data->getUpdateTime())
            );
        }
    }
}

<?php
namespace Sdk\Resource\Data\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Resource\Data\Model\Data;
use Sdk\Resource\Data\Model\NullData;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DataTranslator implements ITranslator
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

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullData::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($resourceData, array $keys = array())
    {
        if (!$resourceData instanceof Data) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'identify',
                'subjectCategory',
                'infoCategory',
                'publicationRange',
                'expireDate',
                'items',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'directorySnapshot' => ['id', 'name', 'directoryId', 'items', 'version', 'versionDescription'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($resourceData->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $resourceData->getSubjectName();
        }
        if (in_array('identify', $keys)) {
            $expression['identify'] = $resourceData->getIdentify();
        }
        if (in_array('expireDate', $keys)) {
            $expression['expireDate'] = $resourceData->getExpireDate();
            $expression['expireDateFormatConvert'] = date('Y-m-d', $resourceData->getExpireDate());
        }
        if (in_array('items', $keys)) {
            $expression['items'] = $resourceData->getItems();
        }
        $expression = $this->typeObjectToArray($resourceData, $keys, $expression);
        $expression = $this->relationObjectToArray($resourceData, $keys, $expression);
        
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $resourceData->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $resourceData->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $resourceData->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $resourceData->getUpdateTime());
        }

        return $expression;
    }

    protected function typeObjectToArray(Data $resourceData, array $keys, array $expression) : array
    {
        if (in_array('subjectCategory', $keys)) {
            $expression['subjectCategory'] = $this->typeFormatConversion(
                $resourceData->getSubjectCategory(),
                Directory::SUBJECT_CATEGORY_CN
            );
        }
        if (in_array('infoCategory', $keys)) {
            $expression['infoCategory'] = $this->typeFormatConversion(
                $resourceData->getInfoCategory(),
                Directory::INFO_CATEGORY_CN
            );
        }
        if (in_array('publicationRange', $keys)) {
            $expression['publicationRange'] = $this->typeFormatConversion(
                $resourceData->getPublicationRange(),
                Directory::PUBLICATION_RANGE_CN
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $resourceData->getStatus(),
                IOperateAble::STATUS_TYPE,
                Data::DATA_STATUS_CN
            );
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $resourceData->getExamineStatus(),
                IExamineAble::EXAMINE_STATUS_TYPE,
                IExamineAble::EXAMINE_STATUS_CN
            );
        }

        return $expression;
    }

    protected function relationObjectToArray(Data $resourceData, array $keys, array $expression) : array
    {
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $resourceData->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['staff'])) {
            $expression['staff'] = $this->getStaffTranslator()->objectToArray(
                $resourceData->getStaff(),
                $keys['staff']
            );
        }
        if (isset($keys['directorySnapshot'])) {
            $expression['directorySnapshot'] = $this->getSnapshotTranslator()->objectToArray(
                $resourceData->getDirectorySnapshot(),
                $keys['directorySnapshot']
            );
        }
        
        return $expression;
    }
}

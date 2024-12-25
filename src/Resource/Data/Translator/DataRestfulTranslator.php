<?php
namespace Sdk\Resource\Data\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Resource\Data\Model\Data;
use Sdk\Resource\Data\Model\NullData;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DataRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getSnapshotRestfulTranslator() : SnapshotRestfulTranslator
    {
        return new SnapshotRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $resourceData = null)
    {
        if (empty($expression)) {
            return NullData::getInstance();
        }

        if ($resourceData == null) {
            $resourceData = new Data();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $resourceData->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $resourceData->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['identify'])) {
            $resourceData->setIdentify($attributes['identify']);
        }
        if (isset($attributes['subjectCategory'])) {
            $resourceData->setSubjectCategory($attributes['subjectCategory']);
        }
        if (isset($attributes['infoCategory'])) {
            $resourceData->setInfoCategory($attributes['infoCategory']);
        }
        if (isset($attributes['publicationRange'])) {
            $resourceData->setPublicationRange($attributes['publicationRange']);
        }
        if (isset($attributes['expireDate'])) {
            $resourceData->setExpireDate($attributes['expireDate']);
        }
        if (isset($attributes['exchangeSyncStatus'])) {
            $resourceData->setExchangeSyncStatus($attributes['exchangeSyncStatus']);
        }
        if (isset($attributes['internalSyncStatus'])) {
            $resourceData->setInternalSyncStatus($attributes['internalSyncStatus']);
        }
        if (isset($attributes['items'])) {
            $resourceData->setItems($attributes['items']);
        }
        if (isset($attributes['examineStatus'])) {
            $resourceData->setExamineStatus($attributes['examineStatus']);
        }
        if (isset($attributes['status'])) {
            $resourceData->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $resourceData->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $resourceData->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $resourceData->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $resourceData->setOrganization($organization);
        }
        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $resourceData->setStaff($staff);
        }
        if (isset($relationships['directorySnapshot'])) {
            $directorySnapshotArray = $this->relationshipFill($relationships['directorySnapshot'], $included);
            $directorySnapshot = $this->getSnapshotRestfulTranslator()->arrayToObject($directorySnapshotArray);
            $resourceData->setDirectorySnapshot($directorySnapshot);
        }
        
        return $resourceData;
    }

    public function objectToArray($resourceData, array $keys = array())
    {
        if (!$resourceData instanceof Data) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'items',
                'staff',
                'directory'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'data'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $resourceData->getId();
        }

        $attributes = array();

        if (in_array('items', $keys)) {
            $attributes['items'] = $resourceData->getItems();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($resourceData->getStaff()->getId())
            );
        }
        
        if (in_array('directory', $keys)) {
            $expression['data']['relationships']['directory']['data'] = array(
                'type' => 'directories',
                'id' => strval($resourceData->getDirectory()->getId())
            );
        }

        return $expression;
    }
}

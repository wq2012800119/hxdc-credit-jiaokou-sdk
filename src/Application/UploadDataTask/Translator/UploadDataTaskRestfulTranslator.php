<?php
namespace Sdk\Application\UploadDataTask\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Application\UploadDataTask\Model\UploadDataTask;
use Sdk\Application\UploadDataTask\Model\NullUploadDataTask;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class UploadDataTaskRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getStaffRestfulTranslator() : StaffRestfulTranslator
    {
        return new StaffRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $uploadDataTask = null)
    {
        if (empty($expression)) {
            return NullUploadDataTask::getInstance();
        }

        if ($uploadDataTask == null) {
            $uploadDataTask = new UploadDataTask();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $uploadDataTask->setId($data['id']);
        }
        if (isset($attributes['category'])) {
            $uploadDataTask->setCategory($attributes['category']);
        }
        if (isset($attributes['name'])) {
            $uploadDataTask->setName($attributes['name']);
        }
        if (isset($attributes['exportFileName'])) {
            $uploadDataTask->setExportFileName($attributes['exportFileName']);
        }
        if (isset($attributes['code'])) {
            $uploadDataTask->setCode($attributes['code']);
        }
        if (isset($attributes['total'])) {
            $uploadDataTask->setTotal($attributes['total']);
        }
        if (isset($attributes['successNum'])) {
            $uploadDataTask->setSuccessNum($attributes['successNum']);
        }
        if (isset($attributes['updatedNum'])) {
            $uploadDataTask->setUpdatedNum($attributes['updatedNum']);
        }
        if (isset($attributes['status'])) {
            $uploadDataTask->setExecutionStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $uploadDataTask->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $uploadDataTask->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $uploadDataTask->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $uploadDataTask->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $uploadDataTask->setStaff($staff);
        }

        return $uploadDataTask;
    }

    public function objectToArray($uploadDataTask, array $keys = array())
    {
        if (!$uploadDataTask instanceof UploadDataTask) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'staff'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'uploadTasks'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $uploadDataTask->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $uploadDataTask->getName();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('staff', $keys)) {
            $expression['data']['relationships']['staff']['data'] = array(
                'type' => 'staff',
                'id' => strval($uploadDataTask->getStaff()->getId())
            );
        }
        
        return $expression;
    }
}

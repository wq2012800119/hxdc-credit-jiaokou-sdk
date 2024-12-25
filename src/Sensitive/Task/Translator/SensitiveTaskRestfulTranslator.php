<?php
namespace Sdk\Sensitive\Task\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Sensitive\Task\Model\SensitiveTask;
use Sdk\Sensitive\Task\Model\NullSensitiveTask;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class SensitiveTaskRestfulTranslator implements IRestfulTranslator
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

    public function arrayToObject(array $expression, $sensitiveTask = null)
    {
        if (empty($expression)) {
            return NullSensitiveTask::getInstance();
        }

        if ($sensitiveTask == null) {
            $sensitiveTask = new SensitiveTask();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $sensitiveTask->setId($data['id']);
        }
        if (isset($attributes['updatedNum'])) {
            $sensitiveTask->setUpdatedNum($attributes['updatedNum']);
        }
        if (isset($attributes['status'])) {
            $sensitiveTask->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $sensitiveTask->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $sensitiveTask->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $sensitiveTask->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $sensitiveTask->setOrganization($organization);
        }

        if (isset($relationships['staff'])) {
            $staffArray = $this->relationshipFill($relationships['staff'], $included);
            $staff = $this->getStaffRestfulTranslator()->arrayToObject($staffArray);
            $sensitiveTask->setStaff($staff);
        }
        
        return $sensitiveTask;
    }

    public function objectToArray($sensitiveTask, array $keys = array())
    {
        unset($sensitiveTask);
        unset($keys);

        return array();
    }
}

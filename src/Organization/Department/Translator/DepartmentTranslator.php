<?php
namespace Sdk\Organization\Department\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Organization\Department\Model\Department;
use Sdk\Organization\Department\Model\NullDepartment;

use Sdk\Organization\Organization\Translator\OrganizationTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class DepartmentTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullDepartment::getInstance();
    }

    public function arrayToObject(array $expression, $department = null)
    {
        if (empty($expression)) {
            return $this->getNullObject();
        }
        
        if ($department == null) {
            $department = new Department();
        }
        
        if (isset($expression['id'])) {
            $department->setId(marmot_decode($expression['id']));
        }
        if (isset($expression['name'])) {
            $department->setName($expression['name']);
        }
        if (isset($expression['organization'])) {
            $organization = $this->getOrganizationTranslator()->arrayToObject($expression['organization']);
            $department->setOrganization($organization);
        }
        if (isset($expression['status'])) {
            $department->setStatus($expression['status']);
        }
        if (isset($expression['createTime'])) {
            $department->setCreateTime($expression['createTime']);
        }
        if (isset($expression['updateTime'])) {
            $department->setUpdateTime($expression['updateTime']);
        }

        return $department;
    }

    public function objectToArray($department, array $keys = array())
    {
        if (!$department instanceof Department) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'organization' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($department->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $department->getName();
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $department->getOrganization(),
                $keys['organization']
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $department->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $department->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $department->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $department->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $department->getUpdateTime());
        }

        return $expression;
    }
}

<?php
namespace Sdk\Organization\Department\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Organization\Department\Model\Department;
use Sdk\Organization\Department\Model\NullDepartment;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class DepartmentRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $department = null)
    {
        if (empty($expression)) {
            return NullDepartment::getInstance();
        }

        if ($department == null) {
            $department = new Department();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $department->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $department->setName($attributes['name']);
        }
        if (isset($attributes['status'])) {
            $department->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $department->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $department->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $department->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $department->setOrganization($organization);
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
                'organization'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'departments'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $department->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $department->getName();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($department->getOrganization()->getId())
            );
        }

        return $expression;
    }
}

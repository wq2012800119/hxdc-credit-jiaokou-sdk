<?php
namespace Sdk\User\Staff\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\NullStaff;

use Sdk\Role\Translator\RoleRestfulTranslator;
use Sdk\Organization\Department\Translator\DepartmentRestfulTranslator;
use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class StaffRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getRoleRestfulTranslator() : RoleRestfulTranslator
    {
        return new RoleRestfulTranslator();
    }

    protected function getDepartmentRestfulTranslator() : DepartmentRestfulTranslator
    {
        return new DepartmentRestfulTranslator();
    }

    protected function getOrganizationRestfulTranslator() : OrganizationRestfulTranslator
    {
        return new OrganizationRestfulTranslator();
    }

    public function arrayToObject(array $expression, $staff = null)
    {
        if (empty($expression)) {
            return NullStaff::getInstance();
        }

        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
            
        if ($staff == null) {
            $category = isset($attributes['category']) ? $attributes['category'] : 0;
            $staff = Staff::create($category);
        }
       
        if (isset($data['id'])) {
            $staff->setId($data['id']);
        }
        if (isset($attributes['subjectName'])) {
            $staff->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['cellphone'])) {
            $staff->setCellphone($attributes['cellphone']);
        }
        if (isset($attributes['idCard'])) {
            $staff->setIdCard($attributes['idCard']);
        }
        if (isset($attributes['password'])) {
            $staff->setPassword($attributes['password']);
        }
        if (isset($attributes['category'])) {
            $staff->setCategory($attributes['category']);
        }
        if (isset($attributes['purview'])) {
            $staff->setPurview($attributes['purview']);
        }
        if (isset($attributes['navigation'])) {
            $staff->setNavigation($attributes['navigation']);
        }
        if (isset($attributes['status'])) {
            $staff->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $staff->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $staff->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $staff->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['organization'])) {
            $organizationArray = $this->relationshipFill($relationships['organization'], $included);
            $organization = $this->getOrganizationRestfulTranslator()->arrayToObject($organizationArray);
            $staff->setOrganization($organization);
        }

        if (isset($relationships['department'])) {
            $departmentArray = $this->relationshipFill($relationships['department'], $included);
            $department = $this->getDepartmentRestfulTranslator()->arrayToObject($departmentArray);
            $staff->setDepartment($department);
        }

        if (isset($relationships['roles'])) {
            $roles = array();
            foreach ($relationships['roles']['data'] as $role) {
                $roleObject['data'] = $role;
                $roleArray = $this->relationshipFill($roleObject, $included);
                $role = $this->getRoleRestfulTranslator()->arrayToObject($roleArray);
                $roles[] = $role;
            }
            $staff->setRoles($roles);
        }

        return $staff;
    }

    public function objectToArray($staff, array $keys = array())
    {
        if (!$staff instanceof Staff) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'cellphone',
                'idCard',
                'password',
                'oldPassword',
                'category',
                'organization',
                'department',
                'roles',
                'navigation'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'staff'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $staff->getId();
        }

        $attributes = array();
        
        if (in_array('subjectName', $keys)) {
            $attributes['subjectName'] = $staff->getSubjectName();
        }
        if (in_array('cellphone', $keys)) {
            $attributes['cellphone'] = $staff->getCellphone();
        }
        if (in_array('navigation', $keys)) {
            $attributes['navigation'] = $staff->getNavigation();
        }
        if (in_array('idCard', $keys)) {
            $attributes['idCard'] = $staff->getIdCard();
        }
        if (in_array('password', $keys)) {
            $attributes['password'] = $staff->getPassword();
        }
        if (in_array('oldPassword', $keys)) {
            $attributes['oldPassword'] = $staff->getOldPassword();
        }
        if (in_array('category', $keys)) {
            $attributes['category'] = $staff->getCategory();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('organization', $keys)) {
            $expression['data']['relationships']['organization']['data'] = array(
                'type' => 'organizations',
                'id' => strval($staff->getOrganization()->getId())
            );
        }
        if (in_array('department', $keys)) {
            $expression['data']['relationships']['department']['data'] = array(
                'type' => 'departments',
                'id' => strval($staff->getDepartment()->getId())
            );
        }
        if (in_array('roles', $keys)) {
            $roleRelationships = array();
            foreach ($staff->getRoles() as $role) {
                $roleRelationships[] = array(
                    'type' => 'roles',
                    'id' => strval($role->getId())
                );
            }

            $expression['data']['relationships']['roles']['data'] = $roleRelationships;
        }

        return $expression;
    }
}

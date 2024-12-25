<?php
namespace Sdk\User\Staff\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Utils\Traits\DesensitizationTrait;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\NullStaff;

use Sdk\Role\Translator\RoleTranslator;
use Sdk\Organization\Department\Translator\DepartmentTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class StaffTranslator implements ITranslator
{
    use TranslatorTrait, DesensitizationTrait;

    protected function getRoleTranslator() : RoleTranslator
    {
        return new RoleTranslator();
    }

    protected function getDepartmentTranslator() : DepartmentTranslator
    {
        return new DepartmentTranslator();
    }

    protected function getOrganizationTranslator() : OrganizationTranslator
    {
        return new OrganizationTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullStaff::getInstance();
    }

    public function arrayToObject(array $expression, $staff = null)
    {
        if (empty($expression)) {
            return $this->getNullObject();
        }
        
        if ($staff == null) {
            $category = isset($expression['category']['id']) ? marmot_decode($expression['category']['id']) : 0;
            $staff = Staff::create($category);
        }

        if (isset($expression['id'])) {
            $staff->setId(marmot_decode($expression['id']));
        }
        if (isset($expression['subjectName'])) {
            $staff->setSubjectName($expression['subjectName']);
        }
        if (isset($expression['cellphone'])) {
            $staff->setCellphone($expression['cellphone']);
        }
        if (isset($expression['idCard'])) {
            $staff->setIdCard($expression['idCard']);
        }
        if (isset($expression['identification'])) {
            $staff->setIdentification($expression['identification']);
        }
        if (isset($expression['category']['id'])) {
            $staff->setCategory(marmot_decode($expression['category']['id']));
        }
        if (isset($expression['purview'])) {
            $staff->setPurview($this->purviewFormatConversionToObject($expression['purview']));
        }
        if (isset($expression['navigation'])) {
            $staff->setNavigation($expression['navigation']);
        }
        if (isset($expression['organization'])) {
            $organization = $this->getOrganizationTranslator()->arrayToObject($expression['organization']);
            $staff->setOrganization($organization);
        }
        if (isset($expression['department'])) {
            $department = $this->getDepartmentTranslator()->arrayToObject($expression['department']);
            $staff->setDepartment($department);
        }
        if (isset($expression['roles'])) {
            $roleList = array();
            foreach ($expression['roles'] as $role) {
                $roleList[] = $this->getRoleTranslator()->arrayToObject($role);
            }

            $staff->setRoles($roleList);
        }
        if (isset($expression['status']['id'])) {
            $staff->setStatus(marmot_decode($expression['status']['id']));
        }
        if (isset($expression['createTime'])) {
            $staff->setCreateTime($expression['createTime']);
        }
        if (isset($expression['updateTime'])) {
            $staff->setUpdateTime($expression['updateTime']);
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
                'identification',
                'idCard',
                'category',
                'purview',
                'navigation',
                'organization' => ['id', 'name'],
                'department' => ['id', 'name'],
                'roles' => [],
                'status',
                'createTime',
                'updateTime',
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($staff->getId());
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $staff->getSubjectName();
        }
        if (in_array('cellphone', $keys)) {
            $expression['cellphone'] = $staff->getCellphone();
            $expression['cellphoneDesensitization'] = $this->cellphoneDataDesensitization($staff->getCellphone());
        }
        if (in_array('identification', $keys)) {
            $expression['identification'] = $staff->getIdentification();
        }
        if (in_array('idCard', $keys)) {
            $expression['idCard'] = $staff->getIdCard();
            $expression['idCardDesensitization'] = $this->idCardDataDesensitization($staff->getIdCard());
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $this->typeFormatConversion($staff->getCategory(), Staff::CATEGORY_CN);
        }
        if (in_array('purview', $keys)) {
            $expression['purview'] = $this->purviewFormatConversionToArray($staff->getPurview());
        }
        if (in_array('navigation', $keys)) {
            $expression['navigation'] = $staff->getNavigation();
        }
        if (isset($keys['organization'])) {
            $expression['organization'] = $this->getOrganizationTranslator()->objectToArray(
                $staff->getOrganization(),
                $keys['organization']
            );
        }
        if (isset($keys['department'])) {
            $expression['department'] = $this->getDepartmentTranslator()->objectToArray(
                $staff->getDepartment(),
                $keys['department']
            );
        }
        if (isset($keys['roles'])) {
            $roles = $staff->getRoles();
            foreach ($roles as $role) {
                $expression['roles'][] = $this->getRoleTranslator()->objectToArray(
                    $role,
                    $keys['roles']
                );
            }
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion($staff->getStatus());
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $staff->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $staff->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $staff->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $staff->getUpdateTime());
        }

        return $expression;
    }

    protected function purviewFormatConversionToArray(array $purview) : array
    {
        $conversionPurview = array();

        foreach ($purview as $key => $each) {
            $conversionPurview[] = array(
                'id' => $key,
                'actions' => $each
            );
        }
        
        return $conversionPurview;
    }

    protected function purviewFormatConversionToObject(array $purview) : array
    {
        $conversionPurview = array();

        foreach ($purview as $each) {
            $conversionPurview[$each['id']] = $each['actions'];
        }
        
        return $conversionPurview;
    }
}

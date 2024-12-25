<?php
namespace Sdk\User\Staff\Utils;

use Sdk\User\Staff\Model\Staff;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Staff $staff, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $staff->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['subjectName'])) {
            $this->assertEquals($attributes['subjectName'], $staff->getSubjectName());
        }
        if (isset($attributes['cellphone'])) {
            $this->assertEquals($attributes['cellphone'], $staff->getCellphone());
        }
        if (isset($attributes['idCard'])) {
            $this->assertEquals($attributes['idCard'], $staff->getIdCard());
        }
        if (isset($attributes['password'])) {
            $this->assertEquals($attributes['password'], $staff->getPassword());
        }
        if (isset($attributes['oldPassword'])) {
            $this->assertEquals($attributes['oldPassword'], $staff->getOldPassword());
        }
        if (isset($attributes['category'])) {
            $this->assertEquals($attributes['category'], $staff->getCategory());
        }
        if (isset($attributes['purview'])) {
            $this->assertEquals($attributes['purview'], $staff->getPurview());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $staff->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $staff->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $staff->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $staff->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['organization']['data'])) {
            $organization = $relationships['organization']['data'];
            $this->assertEquals($organization['type'], 'organizations');
            $this->assertEquals($organization['id'], $staff->getOrganization()->getId());
        }
        if (isset($relationships['department']['data'])) {
            $department = $relationships['department']['data'];
            $this->assertEquals($department['type'], 'departments');
            $this->assertEquals($department['id'], $staff->getDepartment()->getId());
        }
        if (isset($relationships['roles']['data'])) {
            $roles = $relationships['roles']['data'];
            foreach ($roles as $key => $role) {
                $this->assertEquals($role['type'], 'roles');
                $this->assertEquals($role['id'], $staff->getRoles()[$key]->getId());
            }
        }
    }

    public function compareTranslatorEquals(array $expression, Staff $staff)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($staff->getId()));
        }
        if (isset($expression['subjectName'])) {
            $this->assertEquals($expression['subjectName'], $staff->getSubjectName());
        }
        if (isset($expression['cellphone'])) {
            $this->assertEquals($expression['cellphone'], $staff->getCellphone());
        }
        if (isset($expression['identification'])) {
            $this->assertEquals($expression['identification'], $staff->getIdentification());
        }
        if (isset($expression['idCard'])) {
            $this->assertEquals($expression['idCard'], $staff->getIdCard());
        }
        if (isset($expression['content'])) {
            $this->assertEquals($expression['content'], $staff->getContent());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $staff->getCreateTime());
        }
        if (isset($expression['createTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $staff->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $staff->getUpdateTime());
        }
        if (isset($expression['updateTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $staff->getUpdateTime())
            );
        }
    }
}

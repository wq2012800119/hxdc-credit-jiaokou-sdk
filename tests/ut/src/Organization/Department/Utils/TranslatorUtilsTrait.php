<?php
namespace Sdk\Organization\Department\Utils;

use Sdk\Organization\Department\Model\Department;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Department $department, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $department->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $department->getName());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $department->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $department->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $department->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $department->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['organization']['data'])) {
            $organization = $relationships['organization']['data'];
            $this->assertEquals($organization['type'], 'organizations');
            $this->assertEquals($organization['id'], $department->getOrganization()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Department $department)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($department->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $department->getName());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $department->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $department->getCreateTime());
        }
        if (isset($expression['createTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $department->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $department->getUpdateTime());
        }
        if (isset($expression['updateTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $department->getUpdateTime())
            );
        }
    }
}

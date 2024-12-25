<?php
namespace Sdk\Role\Utils;

use Sdk\Role\Model\Role;

/**
 * @todo
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Role $role, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $role->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $role->getName());
        }
        if (isset($attributes['purview'])) {
            $this->assertEquals($attributes['purview'], $role->getPurview());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $role->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $role->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $role->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $role->getUpdateTime());
        }
    }

    public function compareTranslatorEquals(array $expression, Role $role)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($role->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $role->getName());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $role->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $role->getCreateTime());
        }
        if (isset($expression['createTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $role->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $role->getUpdateTime());
        }
        if (isset($expression['updateTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $role->getUpdateTime())
            );
        }
    }
}

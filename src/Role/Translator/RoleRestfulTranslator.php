<?php
namespace Sdk\Role\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Role\Model\Role;
use Sdk\Role\Model\NullRole;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class RoleRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $role = null)
    {
        if (empty($expression)) {
            return NullRole::getInstance();
        }

        if ($role == null) {
            $role = new Role();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();

        if (isset($data['id'])) {
            $role->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $role->setName($attributes['name']);
        }
        if (isset($attributes['purview'])) {
            $role->setPurview($attributes['purview']);
        }
        if (isset($attributes['status'])) {
            $role->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $role->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $role->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $role->setUpdateTime($attributes['updateTime']);
        }

        return $role;
    }

    public function objectToArray($role, array $keys = array())
    {
        if (!$role instanceof Role) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'purview'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'roles'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $role->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $role->getName();
        }
        if (in_array('purview', $keys)) {
            $attributes['purview'] = $role->getPurview();
        }
        $expression['data']['attributes'] = $attributes;
        
        return $expression;
    }
}

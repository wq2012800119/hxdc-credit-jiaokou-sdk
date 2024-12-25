<?php
namespace Sdk\Role\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Role\Model\Role;
use Sdk\Role\Model\NullRole;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class RoleTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullRole::getInstance();
    }
    
    public function arrayToObject(array $expression, $role = null)
    {
        if (empty($expression)) {
            return $this->getNullObject();
        }
        
        if ($role == null) {
            $role = new Role();
        }
        
        if (isset($expression['id'])) {
            $role->setId(marmot_decode($expression['id']));
        }
        if (isset($expression['name'])) {
            $role->setName($expression['name']);
        }
        if (isset($expression['purview'])) {
            $role->setPurview($this->purviewFormatConversionToObject($expression['purview']));
        }
        if (isset($expression['name'])) {
            $role->setName($expression['name']);
        }
        if (isset($expression['status'])) {
            $role->setStatus($expression['status']);
        }
        if (isset($expression['createTime'])) {
            $role->setCreateTime($expression['createTime']);
        }
        if (isset($expression['updateTime'])) {
            $role->setUpdateTime($expression['updateTime']);
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
                'purview',
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($role->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $role->getName();
        }
        if (in_array('purview', $keys)) {
            $expression['purview'] = $this->purviewFormatConversionToArray($role->getPurview());
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $role->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $role->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $role->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $role->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $role->getUpdateTime());
        }

        return $expression;
    }

    protected function purviewFormatConversionToObject(array $purview) : array
    {
        $conversionPurview = array();

        foreach ($purview as $each) {
            $conversionPurview[$each['id']] = $each['actions'];
        }
        
        return $conversionPurview;
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
}

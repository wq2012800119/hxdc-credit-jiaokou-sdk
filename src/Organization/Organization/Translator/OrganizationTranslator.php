<?php
namespace Sdk\Organization\Organization\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Organization\Organization\Model\Organization;
use Sdk\Organization\Organization\Model\NullOrganization;

use Sdk\Dictionary\Item\Translator\ItemTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class OrganizationTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getItemTranslator() : ItemTranslator
    {
        return new ItemTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullOrganization::getInstance();
    }

    public function arrayToObject(array $expression, $organization = null)
    {
        if (empty($expression)) {
            return $this->getNullObject();
        }
        
        if ($organization == null) {
            $organization = new Organization();
        }
        
        if (isset($expression['id'])) {
            $organization->setId(marmot_decode($expression['id']));
        }
        if (isset($expression['name'])) {
            $organization->setName($expression['name']);
        }
        if (isset($expression['shortName'])) {
            $organization->setShortName($expression['shortName']);
        }
        if (isset($expression['unifiedIdentifier'])) {
            $organization->setUnifiedIdentifier($expression['unifiedIdentifier']);
        }
        if (isset($expression['status'])) {
            $organization->setStatus($expression['status']);
        }
        if (isset($expression['createTime'])) {
            $organization->setCreateTime($expression['createTime']);
        }
        if (isset($expression['updateTime'])) {
            $organization->setUpdateTime($expression['updateTime']);
        }

        return $organization;
    }

    public function objectToArray($organization, array $keys = array())
    {
        if (!$organization instanceof Organization) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'name',
                'shortName',
                'unifiedIdentifier',
                'jurisdictionArea' => ['id', 'name'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($organization->getId());
        }
        if (in_array('name', $keys)) {
            $expression['name'] = $organization->getName();
        }
        if (in_array('shortName', $keys)) {
            $expression['shortName'] = $organization->getShortName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $expression['unifiedIdentifier'] = $organization->getUnifiedIdentifier();
        }
        if (isset($keys['jurisdictionArea'])) {
            $expression['jurisdictionArea'] = $this->getItemTranslator()->objectToArray(
                $organization->getJurisdictionArea(),
                $keys['jurisdictionArea']
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $organization->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $organization->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $organization->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $organization->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $organization->getUpdateTime());
        }

        return $expression;
    }
}

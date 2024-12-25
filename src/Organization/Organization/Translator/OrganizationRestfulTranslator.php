<?php
namespace Sdk\Organization\Organization\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Organization\Organization\Model\Organization;
use Sdk\Organization\Organization\Model\NullOrganization;

use Sdk\Dictionary\Item\Translator\ItemRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class OrganizationRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getItemRestfulTranslator() : ItemRestfulTranslator
    {
        return new ItemRestfulTranslator();
    }

    public function arrayToObject(array $expression, $organization = null)
    {
        if (empty($expression)) {
            return NullOrganization::getInstance();
        }

        if ($organization == null) {
            $organization = new Organization();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $organization->setId($data['id']);
        }
        if (isset($attributes['name'])) {
            $organization->setName($attributes['name']);
        }
        if (isset($attributes['shortName'])) {
            $organization->setShortName($attributes['shortName']);
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $organization->setUnifiedIdentifier($attributes['unifiedIdentifier']);
        }
        if (isset($attributes['status'])) {
            $organization->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $organization->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $organization->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $organization->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['jurisdictionArea'])) {
            $jurisdictionAreaArray = $this->relationshipFill($relationships['jurisdictionArea'], $included);
            $jurisdictionArea = $this->getItemRestfulTranslator()->arrayToObject($jurisdictionAreaArray);
            $organization->setJurisdictionArea($jurisdictionArea);
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
                'jurisdictionArea'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'organizations'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $organization->getId();
        }

        $attributes = array();

        if (in_array('name', $keys)) {
            $attributes['name'] = $organization->getName();
        }
        if (in_array('shortName', $keys)) {
            $attributes['shortName'] = $organization->getShortName();
        }
        if (in_array('unifiedIdentifier', $keys)) {
            $attributes['unifiedIdentifier'] = $organization->getUnifiedIdentifier();
        }
        $expression['data']['attributes'] = $attributes;

        if (in_array('jurisdictionArea', $keys)) {
            $expression['data']['relationships']['jurisdictionArea']['data'] = array(
                'type' => 'dictionaryItems',
                'id' => strval($organization->getJurisdictionArea()->getId())
            );
        }

        
        return $expression;
    }
}

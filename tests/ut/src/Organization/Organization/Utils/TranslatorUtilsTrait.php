<?php
namespace Sdk\Organization\Organization\Utils;

use Sdk\Organization\Organization\Model\Organization;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(Organization $organization, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $organization->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['name'])) {
            $this->assertEquals($attributes['name'], $organization->getName());
        }
        if (isset($attributes['shortName'])) {
            $this->assertEquals($attributes['shortName'], $organization->getShortName());
        }
        if (isset($attributes['unifiedIdentifier'])) {
            $this->assertEquals($attributes['unifiedIdentifier'], $organization->getUnifiedIdentifier());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $organization->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $organization->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $organization->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $organization->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['jurisdictionArea']['data'])) {
            $jurisdictionArea = $relationships['jurisdictionArea']['data'];
            $this->assertEquals($jurisdictionArea['type'], 'dictionaryItems');
            $this->assertEquals($jurisdictionArea['id'], $organization->getJurisdictionArea()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, Organization $organization)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($organization->getId()));
        }
        if (isset($expression['name'])) {
            $this->assertEquals($expression['name'], $organization->getName());
        }
        if (isset($expression['shortName'])) {
            $this->assertEquals($expression['shortName'], $organization->getShortName());
        }
        if (isset($expression['unifiedIdentifier'])) {
            $this->assertEquals($expression['unifiedIdentifier'], $organization->getUnifiedIdentifier());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $organization->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $organization->getCreateTime());
        }
        if (isset($expression['createTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $organization->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $organization->getUpdateTime());
        }
        if (isset($expression['updateTimeFormatConvert'])) {
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $organization->getUpdateTime())
            );
        }
    }
}

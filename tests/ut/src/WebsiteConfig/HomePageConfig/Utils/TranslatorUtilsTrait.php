<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Utils;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(HomePageConfig $homePageConfig, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $homePageConfig->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['versionDescription'])) {
            $this->assertEquals($attributes['versionDescription'], $homePageConfig->getVersionDescription());
        }
        if (isset($attributes['content'])) {
            $this->assertEquals($attributes['content'], $homePageConfig->getDiyContent());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $homePageConfig->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $homePageConfig->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $homePageConfig->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $homePageConfig->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $homePageConfig->getStaff()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, HomePageConfig $homePageConfig)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($homePageConfig->getId()));
        }
        if (isset($expression['versionDescription'])) {
            $this->assertEquals($expression['versionDescription'], $homePageConfig->getVersionDescription());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $homePageConfig->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $homePageConfig->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $homePageConfig->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $homePageConfig->getUpdateTime())
            );
        }
    }
}

<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Utils;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(HelpPageConfig $helpPageConfig, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $helpPageConfig->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        if (isset($attributes['title'])) {
            $this->assertEquals($attributes['title'], $helpPageConfig->getTitle());
        }
        if (isset($attributes['style'])) {
            $this->assertEquals($attributes['style'], $helpPageConfig->getStyle());
        }
        if (isset($attributes['content'])) {
            $this->assertEquals($attributes['content'], $helpPageConfig->getDiyContent());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $helpPageConfig->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $helpPageConfig->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $helpPageConfig->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $helpPageConfig->getUpdateTime());
        }

        $relationships = isset($expression['data']['relationships']) ? $expression['data']['relationships'] : array();
        if (isset($relationships['staff']['data'])) {
            $staff = $relationships['staff']['data'];
            $this->assertEquals($staff['type'], 'staff');
            $this->assertEquals($staff['id'], $helpPageConfig->getStaff()->getId());
        }
    }

    public function compareTranslatorEquals(array $expression, HelpPageConfig $helpPageConfig)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($helpPageConfig->getId()));
        }
        if (isset($expression['title'])) {
            $this->assertEquals($expression['title'], $helpPageConfig->getTitle());
        }
        if (isset($expression['status'])) {
            $this->assertEquals($expression['status'], $helpPageConfig->getStatus());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $helpPageConfig->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $helpPageConfig->getCreateTime())
            );
        }
        if (isset($expression['updateTime'])) {
            $this->assertEquals($expression['updateTime'], $helpPageConfig->getUpdateTime());
            $this->assertEquals(
                $expression['updateTimeFormatConvert'],
                date('Y-m-d H:i', $helpPageConfig->getUpdateTime())
            );
        }
    }
}

<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class HomePageConfigTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullHomePageConfig::getInstance();
    }

    public function objectToArray($homePageConfig, array $keys = array())
    {
        if (!$homePageConfig instanceof HomePageConfig) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'versionDescription',
                'diyContent',
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($homePageConfig->getId());
        }
        if (in_array('versionDescription', $keys)) {
            $expression['versionDescription'] = $homePageConfig->getVersionDescription();
        }
        if (in_array('diyContent', $keys)) {
            $expression['diyContent'] = $this->diyContentFormatConversion($homePageConfig->getDiyContent());
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion(
                $homePageConfig->getStatus(),
                HomePageConfig::STATUS_TYPE,
                HomePageConfig::HOME_PAGE_CONFIG_STATUS_CN
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $homePageConfig->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $homePageConfig->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $homePageConfig->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $homePageConfig->getUpdateTime());
        }

        return $expression;
    }

    protected function diyContentFormatConversion(array $diyContent) : array
    {
        if (isset($diyContent['mainNav'])) {
            foreach ($diyContent['mainNav'] as $key => $nav) {
                if (isset($nav['articleCategory'])) {
                    $diyContent['mainNav'][$key]['articleCategory'] = marmot_encode($nav['articleCategory']);
                }
            }
        }

        if (isset($diyContent['articleContent'])) {
            foreach ($diyContent['articleContent'] as $key => $value) {
                if (isset($value['category'])) {
                    $diyContent['articleContent'][$key]['category'] = marmot_encode($value['category']);
                }
            }
        }

        if (isset($diyContent['statistics'])) {
            $statistics = $diyContent['statistics'];
            $statusCounts = array_count_values($statistics);
            $enableStatusCount = isset($statusCounts[IOperateAble::STATUS['ENABLED']]) ?
                        $statusCounts[IOperateAble::STATUS['ENABLED']] :
                        0;

            $diyContent['statistics']['enableStatusCount'] = $enableStatusCount;
        }

        return $diyContent;
    }
}

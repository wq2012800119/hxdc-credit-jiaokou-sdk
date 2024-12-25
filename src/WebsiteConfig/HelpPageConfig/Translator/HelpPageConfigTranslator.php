<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Marmot\Framework\Classes\Filter;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;
use Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class HelpPageConfigTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullHelpPageConfig::getInstance();
    }

    public function objectToArray($helpPageConfig, array $keys = array())
    {
        if (!$helpPageConfig instanceof HelpPageConfig) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'title',
                'style',
                'diyContent',
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($helpPageConfig->getId());
        }
        if (in_array('title', $keys)) {
            $expression['title'] = $helpPageConfig->getTitle();
        }
        if (in_array('style', $keys)) {
            $expression['style'] = $this->typeFormatConversion($helpPageConfig->getStyle(), HelpPageConfig::STYLE_CN);
        }
        if (in_array('diyContent', $keys)) {
            $expression['diyContent'] = $this->diyContentFormatConversion(
                $helpPageConfig->getDiyContent(),
                $helpPageConfig->getStyle()
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $helpPageConfig->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $helpPageConfig->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $helpPageConfig->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $helpPageConfig->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $helpPageConfig->getUpdateTime());
        }

        return $expression;
    }

    protected function diyContentFormatConversion(array $diyContent, int $style) : array
    {
        if ($style == HelpPageConfig::STYLE['STYLE_ONE']) {
            $diyContent = Filter::dhtmlspecialchars($diyContent);
        }

        if ($style == HelpPageConfig::STYLE['STYLE_TWO']) {
            foreach ($diyContent as $key => $each) {
                if (isset($each['status'])) {
                    $diyContent[$key]['status'] =  marmot_encode($each['status']);
                }
                if (isset($each['items'])) {
                    foreach ($each['items'] as $k => $item) {
                        if (isset($item['status'])) {
                            $diyContent[$key]['items'][$k]['status'] =  marmot_encode($item['status']);
                        }
                    }
                }
            }
        }

        if ($style == HelpPageConfig::STYLE['STYLE_THREE']) {
            foreach ($diyContent as $key => $each) {
                if (isset($each['status'])) {
                    $diyContent[$key]['status'] =  marmot_encode($each['status']);
                }
            }
        }

        return $diyContent;
    }
}

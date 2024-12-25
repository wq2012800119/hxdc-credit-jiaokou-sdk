<?php
namespace Sdk\CreditReport\CommonConfig\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;
use Sdk\Common\Model\Interfaces\IOperateAble;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;
use Sdk\CreditReport\CommonConfig\Model\NullCommonConfig;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class CommonConfigTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullCommonConfig::getInstance();
    }

    public function objectToArray($commonConfig, array $keys = array())
    {
        if (!$commonConfig instanceof CommonConfig) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'diyContent',
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($commonConfig->getId());
        }
        if (in_array('diyContent', $keys)) {
            $expression['diyContent'] = $this->diyContentFormatConversion($commonConfig->getDiyContent());
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $commonConfig->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $commonConfig->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $commonConfig->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $commonConfig->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $commonConfig->getUpdateTime());
        }

        return $expression;
    }

    protected function diyContentFormatConversion(array $diyContent) : array
    {
        foreach ($diyContent as $key => $value) {
            if (isset($value['status'])) {
                $diyContent[$key]['status'] = marmot_encode($value['status']);
            }

            if (isset($value['directories'])) {
                foreach ($value['directories'] as $k => $directory) {
                    if (isset($directory['id'])) {
                        $diyContent[$key]['directories'][$k]['id'] = marmot_encode($directory['id']);
                    }
                    if (isset($directory['status'])) {
                        $diyContent[$key]['directories'][$k]['status'] = marmot_encode($directory['status']);
                    }
                }
            }

            if (isset($value['commitment']['status'])) {
                $diyContent[$key]['commitment']['status'] = marmot_encode($value['commitment']['status']);
            }
        }

        return $diyContent;
    }
}

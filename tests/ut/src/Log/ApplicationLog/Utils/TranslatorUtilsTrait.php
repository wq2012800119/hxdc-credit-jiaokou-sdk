<?php
namespace Sdk\Log\ApplicationLog\Utils;

use Sdk\Log\ApplicationLog\Model\ApplicationLog;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
trait TranslatorUtilsTrait
{
    public function compareRestfulTranslatorEquals(ApplicationLog $log, array $expression)
    {
        if (isset($expression['data']['id'])) {
            $this->assertEquals($expression['data']['id'], $log->getId());
        }

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();

        if (isset($attributes['operatorId'])) {
            $this->assertEquals($attributes['operatorId'], $log->getOperatorId());
        }
        if (isset($attributes['operatorIdentify'])) {
            $this->assertEquals($attributes['operatorIdentify'], $log->getOperatorIdentify());
        }
        if (isset($attributes['operatorCategory'])) {
            $this->assertEquals($attributes['operatorCategory'], $log->getOperatorCategory());
        }
        if (isset($attributes['targetCategory'])) {
            $this->assertEquals($attributes['targetCategory'], $log->getTargetCategory());
        }
        if (isset($attributes['targetAction'])) {
            $this->assertEquals($attributes['targetAction'], $log->getTargetAction());
        }
        if (isset($attributes['targetId'])) {
            $this->assertEquals($attributes['targetId'], $log->getTargetId());
        }
        if (isset($attributes['targetName'])) {
            $this->assertEquals($attributes['targetName'], $log->getTargetName());
        }
        if (isset($attributes['description'])) {
            $this->assertEquals($attributes['description'], $log->getDescription());
        }
        if (isset($attributes['errorId'])) {
            $this->assertEquals($attributes['errorId'], $log->getErrorId());
        }
        if (isset($attributes['status'])) {
            $this->assertEquals($attributes['status'], $log->getStatus());
        }
        if (isset($attributes['statusTime'])) {
            $this->assertEquals($attributes['statusTime'], $log->getStatusTime());
        }
        if (isset($attributes['createTime'])) {
            $this->assertEquals($attributes['createTime'], $log->getCreateTime());
        }
        if (isset($attributes['updateTime'])) {
            $this->assertEquals($attributes['updateTime'], $log->getUpdateTime());
        }
    }

    public function compareTranslatorEquals(array $expression, ApplicationLog $log)
    {
        if (isset($expression['id'])) {
            $this->assertEquals($expression['id'], marmot_encode($log->getId()));
        }
        if (isset($expression['operatorId'])) {
            $this->assertEquals($expression['operatorId'], $log->getOperatorId());
        }
        if (isset($expression['operatorIdentify'])) {
            $this->assertEquals($expression['operatorIdentify'], $log->getOperatorIdentify());
        }
        if (isset($expression['targetId'])) {
            $this->assertEquals($expression['targetId'], $log->getTargetId());
        }
        if (isset($expression['targetName'])) {
            $this->assertEquals($expression['targetName'], $log->getTargetName());
        }
        if (isset($expression['description'])) {
            $this->assertEquals($expression['description'], $log->getDescription());
        }
        if (isset($expression['errorId'])) {
            $this->assertEquals($expression['errorId'], $log->getErrorId());
        }
        if (isset($expression['createTime'])) {
            $this->assertEquals($expression['createTime'], $log->getCreateTime());
            $this->assertEquals(
                $expression['createTimeFormatConvert'],
                date('Y-m-d H:i', $log->getCreateTime())
            );
        }
    }
}

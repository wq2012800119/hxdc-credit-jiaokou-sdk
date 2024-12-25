<?php
namespace Sdk\Log\ApplicationLog\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Log\ApplicationLog\Model\ApplicationLog;
use Sdk\Log\ApplicationLog\Model\NullApplicationLog;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class ApplicationLogRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $log = null)
    {
        if (empty($expression)) {
            return NullApplicationLog::getInstance();
        }

        if ($log == null) {
            $log = new ApplicationLog();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();

        if (isset($data['id'])) {
            $log->setId($data['id']);
        }
        if (isset($attributes['operatorId'])) {
            $log->setOperatorId($attributes['operatorId']);
        }
        if (isset($attributes['operatorIdentify'])) {
            $log->setOperatorIdentify($attributes['operatorIdentify']);
        }
        if (isset($attributes['operatorCategory'])) {
            $log->setOperatorCategory($attributes['operatorCategory']);
        }
        if (isset($attributes['targetCategory'])) {
            $log->setTargetCategory($attributes['targetCategory']);
        }
        if (isset($attributes['targetAction'])) {
            $log->setTargetAction($attributes['targetAction']);
        }
        if (isset($attributes['targetId'])) {
            $log->setTargetId($attributes['targetId']);
        }
        if (isset($attributes['targetName'])) {
            $log->setTargetName($attributes['targetName']);
        }
        if (isset($attributes['description'])) {
            $log->setDescription($attributes['description']);
        }
        if (isset($attributes['errorId'])) {
            $log->setErrorId($attributes['errorId']);
        }
        if (isset($attributes['status'])) {
            $log->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $log->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $log->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $log->setUpdateTime($attributes['updateTime']);
        }

        return $log;
    }

    public function objectToArray($log, array $keys = array())
    {
        unset($log);
        unset($keys);
        return [];
    }
}

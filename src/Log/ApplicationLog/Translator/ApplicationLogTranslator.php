<?php
namespace Sdk\Log\ApplicationLog\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Log\ApplicationLog\Model\ApplicationLog;
use Sdk\Log\ApplicationLog\Model\NullApplicationLog;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class ApplicationLogTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullApplicationLog::getInstance();
    }

    public function objectToArray($log, array $keys = array())
    {
        if (!$log instanceof ApplicationLog) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'operatorId',
                'operatorIdentify',
                'operatorCategory',
                'targetCategory',
                'targetAction',
                'targetId',
                'targetName',
                'description',
                'errorId',
                'createTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($log->getId());
        }
        if (in_array('operatorId', $keys)) {
            $expression['operatorId'] = $log->getOperatorId();
        }
        if (in_array('operatorIdentify', $keys)) {
            $expression['operatorIdentify'] = $log->getOperatorIdentify();
        }
        if (in_array('operatorCategory', $keys)) {
            $expression['operatorCategory'] = $this->typeFormatConversion(
                $log->getOperatorCategory(),
                ApplicationLog::OPERATOR_CATEGORY_CN
            );
        }
        if (in_array('targetCategory', $keys)) {
            $expression['targetCategory'] = $this->typeFormatConversion(
                $log->getTargetCategory(),
                ApplicationLog::TARGET_CATEGORY_CN
            );
        }
        if (in_array('targetAction', $keys)) {
            $expression['targetAction'] = $this->typeFormatConversion(
                $log->getTargetAction(),
                ApplicationLog::TARGET_ACTION_CN
            );
        }
        if (in_array('targetId', $keys)) {
            $expression['targetId'] = $log->getTargetId();
        }
        if (in_array('targetName', $keys)) {
            $expression['targetName'] = $log->getTargetName();
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $log->getDescription();
        }
        if (in_array('errorId', $keys)) {
            $expression['errorId'] = $log->getErrorId();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $log->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $log->getCreateTime());
        }

        return $expression;
    }
}

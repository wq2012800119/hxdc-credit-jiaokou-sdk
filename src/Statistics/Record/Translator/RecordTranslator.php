<?php
namespace Sdk\Statistics\Record\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Statistics\Record\Model\Record;
use Sdk\Statistics\Record\Model\NullRecord;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class RecordTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getNullObject() : INull
    {
        return NullRecord::getInstance();
    }

    public function objectToArray($record, array $keys = array())
    {
        if (!$record instanceof Record) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'category',
                'result',
                'status',
                'createTime',
                'updateTime',
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($record->getId());
        }
        if (in_array('category', $keys)) {
            $expression['category'] = $record->getCategory();
        }
        if (in_array('result', $keys)) {
            $expression['result'] = $record->getResult();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $this->statusFormatConversion($record->getStatus());
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $record->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $record->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $record->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $record->getUpdateTime());
        }

        return $expression;
    }
}

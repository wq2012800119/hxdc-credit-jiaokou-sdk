<?php
namespace Sdk\Statistics\Record\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Statistics\Record\Model\Record;
use Sdk\Statistics\Record\Model\NullRecord;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class RecordRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    public function arrayToObject(array $expression, $record = null)
    {
        if (empty($expression)) {
            return NullRecord::getInstance();
        }

        if ($record == null) {
            $record = new Record();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();

        if (isset($data['id'])) {
            $record->setId($data['id']);
        }
        if (isset($attributes['category'])) {
            $record->setCategory($attributes['category']);
        }
        if (isset($attributes['result'])) {
            $record->setResult($attributes['result']);
        }
        if (isset($attributes['status'])) {
            $record->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $record->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $record->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $record->setUpdateTime($attributes['updateTime']);
        }

        return $record;
    }

    public function objectToArray($record, array $keys = array())
    {
        unset($record);
        unset($keys);
        return [];
    }
}

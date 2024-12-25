<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord;
use Sdk\Resource\UploadDataTask\Model\NullUploadDataTaskRecord;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class RecordRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getUploadDataTaskRestfulTranslator() : UploadDataTaskRestfulTranslator
    {
        return new UploadDataTaskRestfulTranslator();
    }

    public function arrayToObject(array $expression, $uploadDataTaskRecord = null)
    {
        if (empty($expression)) {
            return NullUploadDataTaskRecord::getInstance();
        }

        if ($uploadDataTaskRecord == null) {
            $uploadDataTaskRecord = new UploadDataTaskRecord();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $uploadDataTaskRecord->setId($data['id']);
        }
        if (isset($attributes['index'])) {
            $uploadDataTaskRecord->setIndex($attributes['index']);
        }
        if (isset($attributes['items'])) {
            $uploadDataTaskRecord->setItems($attributes['items']);
        }
        if (isset($attributes['errorDescription'])) {
            $uploadDataTaskRecord->setErrorDescription($attributes['errorDescription']);
        }
        if (isset($attributes['failReason'])) {
            $uploadDataTaskRecord->setFailReason($attributes['failReason']);
        }
        if (isset($attributes['errorNumber'])) {
            $uploadDataTaskRecord->setErrorNumber($attributes['errorNumber']);
        }
        if (isset($attributes['status'])) {
            $uploadDataTaskRecord->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $uploadDataTaskRecord->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $uploadDataTaskRecord->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $uploadDataTaskRecord->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['task'])) {
            $uploadDataTaskArray = $this->relationshipFill($relationships['task'], $included);
            $uploadDataTask = $this->getUploadDataTaskRestfulTranslator()->arrayToObject($uploadDataTaskArray);
            $uploadDataTaskRecord->setUploadDataTask($uploadDataTask);
        }

        return $uploadDataTaskRecord;
    }

    public function objectToArray($uploadDataTaskRecord, array $keys = array())
    {
        unset($uploadDataTaskRecord);
        unset($keys);

        return [];
    }
}

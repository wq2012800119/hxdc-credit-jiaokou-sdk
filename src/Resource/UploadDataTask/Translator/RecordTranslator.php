<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord;
use Sdk\Resource\UploadDataTask\Model\NullUploadDataTaskRecord;

class RecordTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getUploadDataTaskTranslator() : UploadDataTaskTranslator
    {
        return new UploadDataTaskTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullUploadDataTaskRecord::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($uploadDataTaskRecord, array $keys = array())
    {
        if (!$uploadDataTaskRecord instanceof UploadDataTaskRecord) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'index',
                'items',
                'errorDescription',
                'failReason',
                'errorNumber',
                'uploadDataTask' => ['id', 'name', 'exportFileName', 'directory' => [], 'directorySnapshot' =>[]],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($uploadDataTaskRecord->getId());
        }
        if (in_array('index', $keys)) {
            $expression['index'] = $uploadDataTaskRecord->getIndex();
        }
        if (in_array('items', $keys)) {
            $expression['items'] = $uploadDataTaskRecord->getItems();
        }
        if (in_array('errorDescription', $keys)) {
            $expression['errorDescription'] = $uploadDataTaskRecord->getErrorDescription();
        }
        if (in_array('failReason', $keys)) {
            $expression['failReason'] = $uploadDataTaskRecord->getFailReason();
        }
        if (in_array('errorNumber', $keys)) {
            $expression['errorNumber'] = $this->typeFormatConversion(
                $uploadDataTaskRecord->getErrorNumber(),
                UploadDataTaskRecord::ERROR_NUMBER_CN
            );
        }
        if (isset($keys['uploadDataTask'])) {
            $expression['uploadDataTask'] = $this->getUploadDataTaskTranslator()->objectToArray(
                $uploadDataTaskRecord->getUploadDataTask(),
                $keys['uploadDataTask']
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $uploadDataTaskRecord->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $uploadDataTaskRecord->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $uploadDataTaskRecord->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $uploadDataTaskRecord->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $uploadDataTaskRecord->getUpdateTime());
        }

        return $expression;
    }
}

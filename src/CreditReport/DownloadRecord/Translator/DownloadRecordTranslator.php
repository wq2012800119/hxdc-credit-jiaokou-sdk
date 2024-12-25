<?php
namespace Sdk\CreditReport\DownloadRecord\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\CreditReport\DownloadRecord\Model\DownloadRecord;
use Sdk\CreditReport\DownloadRecord\Model\NullDownloadRecord;

use Sdk\User\Member\Translator\MemberTranslator;

class DownloadRecordTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullDownloadRecord::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($downloadRecord, array $keys = array())
    {
        if (!$downloadRecord instanceof DownloadRecord) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'domain',
                'target',
                'description',
                'subjectId',
                'subjectCategory',
                'subjectName',
                'member' => ['id', 'subjectName'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($downloadRecord->getId());
        }
        if (in_array('domain', $keys)) {
            $expression['domain'] = $this->typeFormatConversion(
                $downloadRecord->getDomain(),
                DownloadRecord::DOMAIN_CN
            );
        }
        if (in_array('target', $keys)) {
            $expression['target'] = $this->typeFormatConversion(
                $downloadRecord->getTarget(),
                DownloadRecord::TARGET_CN
            );
        }
        if (in_array('description', $keys)) {
            $expression['description'] = $downloadRecord->getDescription();
        }
        if (in_array('subjectId', $keys)) {
            $expression['subjectId'] = $downloadRecord->getSubjectId();
        }
        if (in_array('subjectCategory', $keys)) {
            $expression['subjectCategory'] = $this->typeFormatConversion(
                $downloadRecord->getSubjectCategory(),
                DownloadRecord::SUBJECT_CATEGORY_CN
            );
        }
        if (in_array('subjectName', $keys)) {
            $expression['subjectName'] = $downloadRecord->getSubjectName();
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $downloadRecord->getStatus();
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $downloadRecord->getMember(),
                $keys['member']
            );
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $downloadRecord->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $downloadRecord->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $downloadRecord->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $downloadRecord->getUpdateTime());
        }

        return $expression;
    }
}

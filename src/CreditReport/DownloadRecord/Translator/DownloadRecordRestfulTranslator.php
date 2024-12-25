<?php
namespace Sdk\CreditReport\DownloadRecord\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\CreditReport\DownloadRecord\Model\DownloadRecord;
use Sdk\CreditReport\DownloadRecord\Model\NullDownloadRecord;

use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DownloadRecordRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getMemberRestfulTranslator() : MemberRestfulTranslator
    {
        return new MemberRestfulTranslator();
    }

    public function arrayToObject(array $expression, $downloadRecord = null)
    {
        if (empty($expression)) {
            return NullDownloadRecord::getInstance();
        }

        if ($downloadRecord == null) {
            $downloadRecord = new DownloadRecord();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $downloadRecord->setId($data['id']);
        }
        if (isset($attributes['domain'])) {
            $downloadRecord->setDomain($attributes['domain']);
        }
        if (isset($attributes['target'])) {
            $downloadRecord->setTarget($attributes['target']);
        }
        if (isset($attributes['description'])) {
            $downloadRecord->setDescription($attributes['description']);
        }
        if (isset($attributes['subjectId'])) {
            $downloadRecord->setSubjectId($attributes['subjectId']);
        }
        if (isset($attributes['subjectCategory'])) {
            $downloadRecord->setSubjectCategory($attributes['subjectCategory']);
        }
        if (isset($attributes['subjectName'])) {
            $downloadRecord->setSubjectName($attributes['subjectName']);
        }
        if (isset($attributes['status'])) {
            $downloadRecord->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $downloadRecord->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $downloadRecord->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $downloadRecord->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['member'])) {
            $memberArray = $this->relationshipFill($relationships['member'], $included);
            $member = $this->getMemberRestfulTranslator()->arrayToObject($memberArray);
            $downloadRecord->setMember($member);
        }
        
        return $downloadRecord;
    }

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
                'member'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'creditReportRecords'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $downloadRecord->getId();
        }

        $attributes = array();

        if (in_array('domain', $keys)) {
            $attributes['domain'] = $downloadRecord->getDomain();
        }
        if (in_array('target', $keys)) {
            $attributes['target'] = $downloadRecord->getTarget();
        }
        if (in_array('description', $keys)) {
            $attributes['description'] = $downloadRecord->getDescription();
        }
        if (in_array('subjectId', $keys)) {
            $attributes['subjectId'] = $downloadRecord->getSubjectId();
        }
        if (in_array('subjectCategory', $keys)) {
            $attributes['subjectCategory'] = $downloadRecord->getSubjectCategory();
        }

        $expression['data']['attributes'] = $attributes;

        if (in_array('member', $keys)) {
            $expression['data']['relationships']['member']['data'] = array(
                'type' => 'members',
                'id' => strval($downloadRecord->getMember()->getId())
            );
        }
        
        return $expression;
    }
}

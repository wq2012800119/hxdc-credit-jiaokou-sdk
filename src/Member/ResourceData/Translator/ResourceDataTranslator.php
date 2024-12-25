<?php
namespace Sdk\Member\ResourceData\Translator;

use Marmot\Interfaces\INull;

use Sdk\Member\ResourceData\Model\ResourceData;
use Sdk\Member\ResourceData\Model\NullResourceData;

use Sdk\Resource\Data\Translator\DataTranslator;

use Sdk\User\Member\Translator\MemberTranslator;

class ResourceDataTranslator extends DataTranslator
{
    protected function getMemberTranslator() : MemberTranslator
    {
        return new MemberTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullResourceData::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($resourceData, array $keys = array())
    {
        if (!$resourceData instanceof ResourceData) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'subjectName',
                'identify',
                'subjectCategory',
                'infoCategory',
                'publicationRange',
                'expireDate',
                'items',
                'organization' => ['id', 'name'],
                'staff' => ['id', 'subjectName'],
                'directorySnapshot' => ['id', 'name', 'directoryId', 'items', 'version', 'versionDescription'],
                'rejectReason',
                'certificateType',
                'certificateId',
                'attachments',
                'member' => ['id', 'subjectName'],
                'status',
                'examineStatus',
                'createTime',
                'updateTime'
            );
        }

        $expression = parent::objectToArray($resourceData, $keys);

        if (in_array('attachments', $keys)) {
            $expression['attachments'] = $resourceData->getAttachments();
        }
        if (in_array('certificateId', $keys)) {
            $expression['certificateId'] = $resourceData->getCertificateId();
        }
        if (in_array('rejectReason', $keys)) {
            $expression['rejectReason'] = $resourceData->getRejectReason();
        }
        if (in_array('examineStatus', $keys)) {
            $expression['examineStatus'] = $this->statusFormatConversion(
                $resourceData->getExamineStatus(),
                ResourceData::RESOURCE_DATA_EXAMINE_STATUS_TYPE,
                ResourceData::RESOURCE_DATA_EXAMINE_STATUS_CN
            );
        }
        if (in_array('certificateType', $keys)) {
            $expression['certificateType'] = $this->typeFormatConversion(
                $resourceData->getCertificateType(),
                ResourceData::CERTIFICATE_TYPE_CN
            );
        }
        if (isset($keys['member'])) {
            $expression['member'] = $this->getMemberTranslator()->objectToArray(
                $resourceData->getMember(),
                $keys['member']
            );
        }

        return $expression;
    }
}

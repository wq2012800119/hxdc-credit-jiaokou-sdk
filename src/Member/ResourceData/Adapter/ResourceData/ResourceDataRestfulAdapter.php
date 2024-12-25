<?php
namespace Sdk\Member\ResourceData\Adapter\ResourceData;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleRestfulAdapterTrait;

use Sdk\Member\ResourceData\Model\ResourceData;
use Sdk\Member\ResourceData\Model\NullResourceData;
use Sdk\Member\ResourceData\Translator\ResourceDataRestfulTranslator;

class ResourceDataRestfulAdapter extends CommonRestfulAdapter implements IResourceDataAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        ExamineAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => SUBJECT_NAME_FORMAT_INCORRECT,
            'identify' => DATA_IDENTIFY_FORMAT_INCORRECT,
            'subjectCategory' => DATA_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'infoCategory' => DATA_INFO_CATEGORY_FORMAT_INCORRECT,
            'publicationRange' => DATA_PUBLICATION_RANGE_FORMAT_INCORRECT,
            'expireDate' => DATA_EXPIRE_DATE_FORMAT_INCORRECT,
            'items' => DATA_ITEMS_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'directory' => DATA_DIRECTORY_FORMAT_INCORRECT,
            'attachments' => SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT,
            'certificateType' => SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT,
            'certificateId' => SELF_DECLARATION_CERTIFICATE_ID_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'memberData' => PARAMETER_FORMAT_ERROR,
            'rejectReason' => REASON_FORMAT_INCORRECT,
            'organization' => ORGANIZATION_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'member' => MEMBER_NOT_EXISTS,
            'directory' => DATA_DIRECTORY_NOT_EXISTS,
            'organization' => ORGANIZATION_NOT_EXISTS,
            'directorySnapshot' => DATA_DIRECTORY_SNAPSHOT_NOT_EXISTS,
            'certificate' => SELF_DECLARATION_CERTIFICATE_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'RESOURCE_DATA_LIST'=>[
            'fields' => [
                'memberData' => 'subjectName,identify,expireDate,directorySnapshot,publicationRange,organization,status,examineStatus,updateTime'//phpcs:ignore
            ],
            'include' => 'member,staff,organization,directorySnapshot'
        ],
        'RESOURCE_DATA_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'member,staff,organization,directorySnapshot'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ResourceDataRestfulTranslator(),
            'members/resourceData',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullResourceData::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    private function insertAndUpdateCommonTranslatorKeys() : array
    {
        return array(
            'directory',
            'items',
            'certificateType',
            'certificateId',
            'attachments',
            'organization'
        );
    }

    protected function insertTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }

    public function approve(IExamineAble $resourceData) : bool
    {
        $data = $this->getTranslator()->objectToArray($resourceData, array('staff'));

        $this->patch(
            $this->getResource().'/'.$resourceData->getId().'/approve',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($resourceData);
            return true;
        }

        return false;
    }

    public function reject(IExamineAble $resourceData) : bool
    {
        $data = $this->getTranslator()->objectToArray($resourceData, array('rejectReason', 'staff'));

        $this->patch(
            $this->getResource().'/'.$resourceData->getId().'/reject',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($resourceData);
            return true;
        }

        return false;
    }

    public function revoke(ResourceData $resourceData) : bool
    {
        $this->patch(
            $this->getResource().'/'.$resourceData->getId().'/revoke'
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($resourceData);
            return true;
        }

        return false;
    }
}

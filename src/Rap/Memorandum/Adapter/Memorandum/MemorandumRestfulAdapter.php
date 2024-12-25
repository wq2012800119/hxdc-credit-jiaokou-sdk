<?php
namespace Sdk\Rap\Memorandum\Adapter\Memorandum;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Rap\Memorandum\Model\NullMemorandum;
use Sdk\Rap\Memorandum\Translator\MemorandumRestfulTranslator;

class MemorandumRestfulAdapter extends CommonRestfulAdapter implements IMemorandumAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => RAP_MEMORANDUM_NAME_FORMAT_INCORRECT,
            'documentNo' => RAP_MEMORANDUM_DOCUMENT_NO_FORMAT_INCORRECT,
            'originatingUnit' => RAP_MEMORANDUM_ORIGINATING_UNIT_FORMAT_INCORRECT,
            'releaseDate' => RAP_MEMORANDUM_RELEASE_DATE_FORMAT_INCORRECT,
            'rewardType' => RAP_MEMORANDUM_REWARD_TYPE_FORMAT_INCORRECT,
            'jointSigningDepartment' => RAP_MEMORANDUM_JOINT_SIGNING_DEPARTMENT_FORMAT_INCORRECT ,
            'content' => RAP_MEMORANDUM_CONTENT_FORMAT_INCORRECT,
            'attachments' => RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT ,
            'attachmentsCount' => RAP_MEMORANDUM_ATTACHMENTS_COUNT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'MEMORANDUM_LIST'=>[
            'fields' => [
                'memorandums'=>
                    'name,documentNo,originatingUnit,releaseDate,rewardType,organization,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'MEMORANDUM_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new MemorandumRestfulTranslator(),
            'rap/memorandums',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullMemorandum::getInstance();
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
            'name',
            'documentNo',
            'originatingUnit',
            'releaseDate',
            'jointSigningDepartment',
            'content',
            'attachments'
        );
    }

    protected function insertTranslatorKeys() : array
    {
        $keys = $this->insertAndUpdateCommonTranslatorKeys();
        array_push($keys, 'staff', 'rewardType');

        return $keys;
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }
}

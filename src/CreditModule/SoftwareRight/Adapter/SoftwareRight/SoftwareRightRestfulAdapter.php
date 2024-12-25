<?php
namespace Sdk\CreditModule\SoftwareRight\Adapter\SoftwareRight;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\SoftwareRight\Model\NullSoftwareRight;
use Sdk\CreditModule\SoftwareRight\Translator\SoftwareRightRestfulTranslator;

class SoftwareRightRestfulAdapter extends CommonRestfulAdapter implements ISoftwareRightAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_SOFTWARERIGHT_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_SOFTWARERIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'title' => CM_SOFTWARERIGHT_TITLE_FORMAT_INCORRECT,
            'version' => CM_SOFTWARERIGHT_VERSION_FORMAT_INCORRECT,
            'category' => CM_SOFTWARERIGHT_CATEGORY_FORMAT_INCORRECT,
            'registrationNumber' => CM_SOFTWARERIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT,
            'registrationApprovalDate' => CM_SOFTWARERIGHT_REGISTRATION_APPROVAL_DATE_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'SOFTWARERIGHT_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'SOFTWARERIGHT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new SoftwareRightRestfulTranslator(),
            'creditModule/softwareRights',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullSoftwareRight::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }
    
    protected function insertTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'title',
            'version',
            'category',
            'registrationNumber',
            'registrationApprovalDate',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'title',
            'version',
            'category',
            'registrationNumber',
            'registrationApprovalDate'
        );
    }
}

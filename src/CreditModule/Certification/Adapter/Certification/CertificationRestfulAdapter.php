<?php
namespace Sdk\CreditModule\Certification\Adapter\Certification;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\Certification\Model\NullCertification;
use Sdk\CreditModule\Certification\Translator\CertificationRestfulTranslator;

class CertificationRestfulAdapter extends CommonRestfulAdapter implements ICertificationAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_CERTIFICATION_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_CERTIFICATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'name' => CM_CERTIFICATION_NAME_FORMAT_INCORRECT,
            'pubDate' => CM_CERTIFICATION_PUB_DATE_FORMAT_INCORRECT,
            'validateDate' => CM_CERTIFICATION_VALIDATE_DATE_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'CERTIFICATION_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'CERTIFICATION_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CertificationRestfulTranslator(),
            'creditModule/certifications',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCertification::getInstance();
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
            'name',
            'pubDate',
            'validateDate',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'name',
            'pubDate',
            'validateDate'
        );
    }
}

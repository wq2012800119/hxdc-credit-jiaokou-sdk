<?php
namespace Sdk\CreditModule\Copyright\Adapter\Copyright;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\Copyright\Model\NullCopyright;
use Sdk\CreditModule\Copyright\Translator\CopyrightRestfulTranslator;

class CopyrightRestfulAdapter extends CommonRestfulAdapter implements ICopyrightAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_COPYRIGHT_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_COPYRIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'title' => CM_COPYRIGHT_TITLE_FORMAT_INCORRECT,
            'registrationNumber' => CM_COPYRIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT,
            'conditions' => CM_COPYRIGHT_CONDITIONS_FORMAT_INCORRECT,
            'registrationDate' => CM_COPYRIGHT_REGISTRATION_DATE_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'COPYRIGHT_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'COPYRIGHT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new CopyrightRestfulTranslator(),
            'creditModule/copyrights',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullCopyright::getInstance();
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
            'registrationNumber',
            'conditions',
            'registrationDate',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'title',
            'registrationNumber',
            'conditions',
            'registrationDate'
        );
    }
}

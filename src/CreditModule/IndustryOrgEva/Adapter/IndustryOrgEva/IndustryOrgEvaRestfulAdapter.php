<?php
namespace Sdk\CreditModule\IndustryOrgEva\Adapter\IndustryOrgEva;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditModule\IndustryOrgEva\Model\NullIndustryOrgEva;
use Sdk\CreditModule\IndustryOrgEva\Translator\IndustryOrgEvaRestfulTranslator;

class IndustryOrgEvaRestfulAdapter extends CommonRestfulAdapter implements IIndustryOrgEvaAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'subjectName' => CM_INDUSTRYORGEVA_SUBJECT_NAME_FORMAT_INCORRECT,
            'unifiedIdentifier' => CM_INDUSTRYORGEVA_UNIFIED_IDENTIFIER_FORMAT_INCORRECT,
            'industryName' => CM_INDUSTRYORGEVA_INDUSTRY_NAME_FORMAT_INCORRECT,
            'evaluationType' => CM_INDUSTRYORGEVA_EVALUATION_TYPE_FORMAT_INCORRECT,
            'evaluationContent' => CM_INDUSTRYORGEVA_EVALUATION_CONTENT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'INDUSTRYORGEVA_LIST'=>[
            'fields' => [
                'directories'=>
                    'subjectName,unifiedIdentifier,status,updateTime',
            ],
            'include' => 'organization'
        ],
        'INDUSTRYORGEVA_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new IndustryOrgEvaRestfulTranslator(),
            'creditModule/industryOrganizationEvaluations',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullIndustryOrgEva::getInstance();
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
            'industryName',
            'evaluationType',
            'evaluationContent',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'subjectName',
            'unifiedIdentifier',
            'industryName',
            'evaluationType',
            'evaluationContent'
        );
    }
}

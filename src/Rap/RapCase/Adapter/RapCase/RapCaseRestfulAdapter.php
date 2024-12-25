<?php
namespace Sdk\Rap\RapCase\Adapter\RapCase;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Rap\RapCase\Model\NullRapCase;
use Sdk\Rap\RapCase\Translator\RapCaseRestfulTranslator;

class RapCaseRestfulAdapter extends CommonRestfulAdapter implements IRapCaseAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'documentType' => RAP_CASE_ZJLX_FORMAT_INCORRECT,
            'measure' => RAP_CASE_MEASURE_FORMAT_INCORRECT,
            'data' => RAP_CASE_DATA_FORMAT_INCORRECT,
            'price' => RAP_CASE_SJJE_FORMAT_INCORRECT,
            'description' => RAP_CASE_JCSM_FORMAT_INCORRECT,
            'feedbackOrganization' => RAP_CASE_FEEDBACK_ORGANIZATION_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'case' => PARAMETER_FORMAT_ERROR,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100004 => array(
            'measure' => RAP_CASE_MEASURE_NOT_EXISTS,
            'data' => RAP_CASE_DATA_NOT_EXISTS,
            'feedbackOrganization' => RAP_CASE_FEEDBACK_ORGANIZATION_NOT_EXISTS,
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'CASE_LIST'=>[
            'fields' => [
                'rapCases'=>
                    'feedbackOrganization,HHMDMC,ZTMC,ZXCSNR,JCLX,organization,status,updateTime,createTime',
            ],
            'include' => 'staff,organization,measure,data,feedbackOrganization'
        ],
        'CASE_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,measure,data,feedbackOrganization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new RapCaseRestfulTranslator(),
            'rap/cases',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullRapCase::getInstance();
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
            'zjlx',
            'jcsm',
            'sjje',
            'data',
            'fkbm',
            'measure',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return [];
    }
}

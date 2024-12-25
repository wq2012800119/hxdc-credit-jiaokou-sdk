<?php
namespace Sdk\CreditReport\DownloadRecord\Adapter\DownloadRecord;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\CreditReport\DownloadRecord\Model\NullDownloadRecord;
use Sdk\CreditReport\DownloadRecord\Translator\DownloadRecordRestfulTranslator;

class DownloadRecordRestfulAdapter extends CommonRestfulAdapter implements IDownloadRecordAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'domain' => CREDIT_REPORT_DOWNLOAD_RECORD_DOMAIN_FORMAT_INCORRECT,
            'target' => CREDIT_REPORT_DOWNLOAD_RECORD_TARGET_FORMAT_INCORRECT,
            'description' => CREDIT_REPORT_DOWNLOAD_RECORD_DESCRIPTION_FORMAT_INCORRECT,
            'subject' => CREDIT_REPORT_DOWNLOAD_RECORD_SUBJECT_FORMAT_INCORRECT,
            'subjectCategory' =>  CREDIT_REPORT_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'creditReportRecord' => PARAMETER_INCORRECT
        ),
        100004 => array(
            'member' => MEMBER_NOT_EXISTS,
            'subject' => CREDIT_REPORT_SUBJECT_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'DOWNLOAD_RECORD_LIST'=>[
            'fields' => [],
            'include' => 'member'
        ],
        'DOWNLOAD_RECORD_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'member'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new DownloadRecordRestfulTranslator(),
            'report/records',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullDownloadRecord::getInstance();
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
            'domain',
            'target',
            'description',
            'subjectId',
            'subjectCategory',
            'member'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return [];
    }
}

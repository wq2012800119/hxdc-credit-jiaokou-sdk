<?php
namespace Sdk\Monitor\FocusMonitor\Adapter\FocusMonitor;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Monitor\FocusMonitor\Model\NullFocusMonitor;
use Sdk\Monitor\FocusMonitor\Translator\FocusMonitorRestfulTranslator;

class FocusMonitorRestfulAdapter extends CommonRestfulAdapter implements IFocusMonitorAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => SUBJECT_NAME_FORMAT_INCORRECT,
            'identify' => MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT,
            'subjectCategory' => MONITOR_FOCUS_MONITOR_SUBJECT_CATEGORY_FORMAT_INCORRECT,
            'penaltyThreshold' => MONITOR_FOCUS_MONITOR_PENALTY_THRESHOLD_FORMAT_INCORRECT,
            'dishonestyThreshold' => MONITOR_FOCUS_MONITOR_DISHONESTY_THRESHOLD_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100003 => MONITOR_FOCUS_MONITOR_IDENTIFY_EXISTS,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS
        )
    );

    const SCENARIOS = [
        'FOCUS_MONITOR_LIST'=>[
            'fields' => [
                'focusMonitors'=>
                    'name,subjectCategory,penaltyThreshold,dishonestyThreshold,organization,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'FOCUS_MONITOR_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new FocusMonitorRestfulTranslator(),
            'monitor/focusMonitors',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullFocusMonitor::getInstance();
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
            'subjectCategory',
            'identify',
            'penaltyThreshold',
            'dishonestyThreshold'
        );
    }

    protected function insertTranslatorKeys() : array
    {
        $keys = $this->insertAndUpdateCommonTranslatorKeys();
        array_push($keys, 'staff');

        return $keys;
    }

    protected function updateTranslatorKeys() : array
    {
        return $this->insertAndUpdateCommonTranslatorKeys();
    }
}

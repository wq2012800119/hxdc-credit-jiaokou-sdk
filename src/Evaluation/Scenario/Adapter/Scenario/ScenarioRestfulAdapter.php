<?php
namespace Sdk\Evaluation\Scenario\Adapter\Scenario;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Evaluation\Scenario\Model\NullScenario;
use Sdk\Evaluation\Scenario\Translator\ScenarioRestfulTranslator;

class ScenarioRestfulAdapter extends CommonRestfulAdapter implements IScenarioAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT,
            'description' => EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT,
            'scoreModel' => EVALUATION_SCENARIO_SCORE_MODEL_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'scenario' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'scoreModel' => EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'SCENARIO_LIST'=>[
            'fields' => [
                'scenarios'=>
                    'name,description,scoreModel,status,updateTime',
            ],
            'include' => 'staff,organization,scoreModel'
        ],
        'SCENARIO_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,scoreModel'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ScenarioRestfulTranslator(),
            'evaluation/scenarios',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullScenario::getInstance();
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
            'name',
            'description',
            'scoreModel',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'description',
            'scoreModel'
        );
    }
}

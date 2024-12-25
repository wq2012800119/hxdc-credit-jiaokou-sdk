<?php
namespace Sdk\Evaluation\Scenario\Adapter\EvaluationReport;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;
use Sdk\Evaluation\Scenario\Model\NullEvaluationReport;
use Sdk\Evaluation\Scenario\Translator\EvaluationReportRestfulTranslator;

class EvaluationReportRestfulAdapter extends CommonRestfulAdapter implements IEvaluationReportAdapter
{
    use MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'enterprise' => EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT,
            'naturalPerson' => EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'scoreObject' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'enterprise' => EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS,
            'naturalPerson' => EVALUATION_SCENARIO_SCORE_MODEL_NOT_EXISTS
        ),
    );
    
    const SCENARIOS = [
        'EVALUATION_REPORT_LIST'=>[
            'fields' => [],
            'include' => 'enterprise,naturalPerson'
        ],
        'EVALUATION_REPORT_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'enterprise,naturalPerson'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new EvaluationReportRestfulTranslator(),
            'evaluation/scenarios',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullEvaluationReport::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    public function evaluate(EvaluationReport $evaluationReport) : bool
    {
        $data = $this->getTranslator()->objectToArray($evaluationReport, array('enterprise', 'naturalPerson'));

        $this->post(
            $this->getResource().'/'.$evaluationReport->getId().'/evaluate',
            $data
        );
        
        if ($this->isSuccess()) {
            $this->translateToObject($evaluationReport);
            return true;
        }

        return false;
    }
}

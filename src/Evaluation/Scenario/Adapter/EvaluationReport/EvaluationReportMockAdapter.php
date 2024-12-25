<?php
namespace Sdk\Evaluation\Scenario\Adapter\EvaluationReport;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;

class EvaluationReportMockAdapter implements IEvaluationReportAdapter
{
    //评估
    public function evaluate(EvaluationReport $evaluationReport) : bool
    {
        unset($evaluationReport);
        
        return true;
    }
}

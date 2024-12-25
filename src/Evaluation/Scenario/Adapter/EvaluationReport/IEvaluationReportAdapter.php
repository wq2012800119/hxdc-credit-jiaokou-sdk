<?php
namespace Sdk\Evaluation\Scenario\Adapter\EvaluationReport;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;

interface IEvaluationReportAdapter
{
    //评估
    public function evaluate(EvaluationReport $evaluationReport) : bool;
}

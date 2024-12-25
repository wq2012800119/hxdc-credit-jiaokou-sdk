<?php
namespace Sdk\Evaluation\Scenario\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;
use Sdk\Evaluation\Scenario\Adapter\EvaluationReport\IEvaluationReportAdapter;
use Sdk\Evaluation\Scenario\Adapter\EvaluationReport\EvaluationReportMockAdapter;
use Sdk\Evaluation\Scenario\Adapter\EvaluationReport\EvaluationReportRestfulAdapter;

class EvaluationReportRepository extends CommonRepository implements IEvaluationReportAdapter
{
    const LIST_MODEL_UN = 'EVALUATION_REPORT_LIST';
    const FETCH_ONE_MODEL_UN = 'EVALUATION_REPORT_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new EvaluationReportRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new EvaluationReportMockAdapter()
        );
    }

    public function evaluate(EvaluationReport $evaluationReport) : bool
    {
        return $this->getActualAdapter()->evaluate($evaluationReport);
    }
}

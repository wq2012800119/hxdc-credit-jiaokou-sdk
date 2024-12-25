<?php
namespace Sdk\Evaluation\Scenario\Translator;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\ITranslator;
use Sdk\Common\Translator\TranslatorTrait;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;
use Sdk\Evaluation\Scenario\Model\NullEvaluationReport;

use Sdk\Resource\Enterprise\Translator\EnterpriseTranslator;
use Sdk\Evaluation\ScoreModel\Translator\ScoreModelTranslator;
use Sdk\Resource\NaturalPerson\Translator\NaturalPersonTranslator;

class EvaluationReportTranslator implements ITranslator
{
    use TranslatorTrait;

    protected function getEnterpriseTranslator() : EnterpriseTranslator
    {
        return new EnterpriseTranslator();
    }

    protected function getNaturalPersonTranslator() : NaturalPersonTranslator
    {
        return new NaturalPersonTranslator();
    }

    protected function getScoreModelTranslator() : ScoreModelTranslator
    {
        return new ScoreModelTranslator();
    }

    protected function getNullObject() : INull
    {
        return NullEvaluationReport::getInstance();
    }
    /**
     * @todo
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($evaluationReport, array $keys = array())
    {
        if (!$evaluationReport instanceof EvaluationReport) {
            return array();
        }
        
        if (empty($keys)) {
            $keys = array(
                'id',
                'indicatorResults',
                'rating',
                'score',
                'enterprise' => [],
                'naturalPerson' => [],
                'scoreModel' => ['id', 'name', 'maxScore', 'baseScore', 'ranks'],
                'status',
                'createTime',
                'updateTime'
            );
        }

        
        $expression = array();

        if (in_array('id', $keys)) {
            $expression['id'] = marmot_encode($evaluationReport->getId());
        }
        if (in_array('indicatorResults', $keys)) {
            $expression['indicatorResults'] = $evaluationReport->getIndicatorResults();
        }
        if (in_array('rating', $keys)) {
            $expression['rating'] = $evaluationReport->getRating();
        }
        if (in_array('score', $keys)) {
            $expression['score'] = $evaluationReport->getScore();
        }
        if (isset($keys['enterprise']) && !empty($evaluationReport->getEnterprise()->getId())) {
            $expression['enterprise'] = $this->getEnterpriseTranslator()->objectToArray(
                $evaluationReport->getEnterprise(),
                $keys['enterprise']
            );
        }
        if (isset($keys['naturalPerson']) && !empty($evaluationReport->getNaturalPerson()->getId())) {
            $expression['naturalPerson'] = $this->getNaturalPersonTranslator()->objectToArray(
                $evaluationReport->getNaturalPerson(),
                $keys['naturalPerson']
            );
        }
        if (isset($keys['scoreModel'])) {
            $expression['scoreModel'] = $this->getScoreModelTranslator()->objectToArray(
                $evaluationReport->getScoreModel(),
                $keys['scoreModel']
            );
        }
        if (in_array('status', $keys)) {
            $expression['status'] = $evaluationReport->getStatus();
        }
        if (in_array('createTime', $keys)) {
            $expression['createTime'] = $evaluationReport->getCreateTime();
            $expression['createTimeFormatConvert'] = date('Y-m-d H:i', $evaluationReport->getCreateTime());
        }
        if (in_array('updateTime', $keys)) {
            $expression['updateTime'] = $evaluationReport->getUpdateTime();
            $expression['updateTimeFormatConvert'] = date('Y-m-d H:i', $evaluationReport->getUpdateTime());
        }

        return $expression;
    }
}

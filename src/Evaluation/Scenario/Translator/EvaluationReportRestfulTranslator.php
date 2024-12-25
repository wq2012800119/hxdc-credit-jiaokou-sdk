<?php
namespace Sdk\Evaluation\Scenario\Translator;

use Marmot\Interfaces\IRestfulTranslator;
use Sdk\Common\Translator\RestfulTranslatorTrait;

use Sdk\Evaluation\Scenario\Model\EvaluationReport;
use Sdk\Evaluation\Scenario\Model\NullEvaluationReport;

use Sdk\Resource\Enterprise\Translator\EnterpriseRestfulTranslator;
use Sdk\Evaluation\ScoreModel\Translator\ScoreModelRestfulTranslator;
use Sdk\Resource\NaturalPerson\Translator\NaturalPersonRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class EvaluationReportRestfulTranslator implements IRestfulTranslator
{
    use RestfulTranslatorTrait;
    
    protected function getEnterpriseRestfulTranslator() : EnterpriseRestfulTranslator
    {
        return new EnterpriseRestfulTranslator();
    }

    protected function getNaturalPersonRestfulTranslator() : NaturalPersonRestfulTranslator
    {
        return new NaturalPersonRestfulTranslator();
    }

    protected function getScoreModelRestfulTranslator() : ScoreModelRestfulTranslator
    {
        return new ScoreModelRestfulTranslator();
    }

    public function arrayToObject(array $expression, $evaluationReport = null)
    {
        if (empty($expression)) {
            return NullEvaluationReport::getInstance();
        }

        if ($evaluationReport == null) {
            $evaluationReport = new EvaluationReport();
        }
       
        $data = $expression['data'];
        $attributes = isset($data['attributes']) ? $data['attributes'] : array();
        $relationships = isset($data['relationships']) ? $data['relationships'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();
        
        if (isset($data['id'])) {
            $evaluationReport->setId($data['id']);
        }
        if (isset($attributes['indicatorResults'])) {
            $evaluationReport->setIndicatorResults($attributes['indicatorResults']);
        }
        if (isset($attributes['rating'])) {
            $evaluationReport->setRating($attributes['rating']);
        }
        if (isset($attributes['score'])) {
            $evaluationReport->setScore($attributes['score']);
        }
        if (isset($attributes['status'])) {
            $evaluationReport->setStatus($attributes['status']);
        }
        if (isset($attributes['statusTime'])) {
            $evaluationReport->setStatusTime($attributes['statusTime']);
        }
        if (isset($attributes['createTime'])) {
            $evaluationReport->setCreateTime($attributes['createTime']);
        }
        if (isset($attributes['updateTime'])) {
            $evaluationReport->setUpdateTime($attributes['updateTime']);
        }

        if (!empty($included)) {
            $included = $this->includedFormatConversion($included);
        }

        if (isset($relationships['enterprise'])) {
            $enterpriseArray = $this->relationshipFill($relationships['enterprise'], $included);
            $enterprise = $this->getEnterpriseRestfulTranslator()->arrayToObject($enterpriseArray);
            $evaluationReport->setEnterprise($enterprise);
        }

        if (isset($relationships['naturalPerson'])) {
            $naturalPersonArray = $this->relationshipFill($relationships['naturalPerson'], $included);
            $naturalPerson = $this->getNaturalPersonRestfulTranslator()->arrayToObject($naturalPersonArray);
            $evaluationReport->setNaturalPerson($naturalPerson);
        }
        
        if (isset($relationships['scoreModel'])) {
            $scoreModelArray = $this->relationshipFill($relationships['scoreModel'], $included);
            $scoreModel = $this->getScoreModelRestfulTranslator()->arrayToObject($scoreModelArray);
            $evaluationReport->setScoreModel($scoreModel);
        }

        return $evaluationReport;
    }

    public function objectToArray($evaluationReport, array $keys = array())
    {
        if (!$evaluationReport instanceof EvaluationReport) {
            return array();
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'enterprise',
                'naturalPerson'
            );
        }

        $expression = array(
            'data' => array(
                'type' => 'scenarios'
            )
        );

        if (in_array('id', $keys)) {
            $expression['data']['id'] = $evaluationReport->getId();
        }

        if (in_array('enterprise', $keys) && !empty($evaluationReport->getEnterprise()->getId())) {
            $expression['data']['relationships']['enterprise']['data'] = array(
                'type' => 'enterprises',
                'id' => strval($evaluationReport->getEnterprise()->getId())
            );
        }
        
        if (in_array('naturalPerson', $keys) && !empty($evaluationReport->getNaturalPerson()->getId())) {
            $expression['data']['relationships']['naturalPerson']['data'] = array(
                'type' => 'naturalPerson',
                'id' => strval($evaluationReport->getNaturalPerson()->getId())
            );
        }

        return $expression;
    }
}

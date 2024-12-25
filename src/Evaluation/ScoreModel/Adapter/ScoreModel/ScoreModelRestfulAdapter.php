<?php
namespace Sdk\Evaluation\ScoreModel\Adapter\ScoreModel;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;

use Sdk\Evaluation\ScoreModel\Model\NullScoreModel;
use Sdk\Evaluation\ScoreModel\Translator\ScoreModelRestfulTranslator;

class ScoreModelRestfulAdapter extends CommonRestfulAdapter implements IScoreModelAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'name' => EVALUATION_SCORE_MODEL_NAME_FORMAT_INCORRECT,
            'object' => EVALUATION_SCORE_MODEL_OBJECT_FORMAT_INCORRECT,
            'description' => EVALUATION_SCORE_MODEL_DESCRIPTION_FORMAT_INCORRECT,
            'maxScore' => EVALUATION_SCORE_MODEL_MAX_SCORE_FORMAT_INCORRECT,
            'baseScore' => EVALUATION_SCORE_MODEL_BASE_SCORE_FORMAT_INCORRECT,
            'ranks' => EVALUATION_SCORE_MODEL_RANKS_FORMAT_INCORRECT,
            'indicatorWeights' => EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            '' => PARAMETER_FORMAT_ERROR,
            'scoreModel' => PARAMETER_FORMAT_ERROR
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100701 => EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_BELOW_BASE_SCORE,
        100702 => EVALUATION_SCORE_MODEL_RANKS_SCORE_OVERLAP,
        100703 => EVALUATION_SCORE_MODEL_RANKS_MIN_SCORE_BELOW_MIN_SCORE,
        100704 => EVALUATION_SCORE_MODEL_RANKS_MAX_SCORE_HIGHER_THAN_MAX_SCORE,
        100705 => EVALUATION_SCORE_MODEL_RANKS_SCORE_INCOHERENCE,
        100706 => EVALUATION_SCORE_MODEL_OBJECT_INDICATOR_SOURCE_SUBJECT_CATEGORY_MISMATCHING,
        100707 => EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_PERCENTAGE_SUM_NOT_EQUAL_EXPECTED,
        100708 => EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_INDICATOR_EXISTS,
        100709 => EVALUATION_SCORE_MODEL_RANKS_RATING_EXISTS,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'ranks' => EVALUATION_SCORE_MODEL_RANKS_NOT_EXISTS,
            'indicatorWeights' => EVALUATION_SCORE_MODEL_INDICATOR_WEIGHTS_NOT_EXISTS,
        ),
    );
    
    
    const SCENARIOS = [
        'SCORE_MODEL_LIST'=>[
            'fields' => [
                'directories'=>
                    'name,object,status,updateTime',
            ],
            'include' => 'staff,organization'
        ],
        'SCORE_MODEL_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new ScoreModelRestfulTranslator(),
            'evaluation/scoreModels',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullScoreModel::getInstance();
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
            'object',
            'maxScore',
            'baseScore',
            'ranks',
            'indicatorWeights',
            'staff'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array(
            'name',
            'description',
            'object',
            'maxScore',
            'baseScore',
            'ranks',
            'indicatorWeights'
        );
    }
}

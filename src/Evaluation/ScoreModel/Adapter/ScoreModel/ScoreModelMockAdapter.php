<?php
namespace Sdk\Evaluation\ScoreModel\Adapter\ScoreModel;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Evaluation\ScoreModel\Model\ScoreModel;

//use Sdk\Evaluation\ScoreModel\Utils\MockObjectGenerate;

class ScoreModelMockAdapter implements IScoreModelAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new ScoreModel($id);
        //return MockObjectGenerate::generateScoreModel($id);
    }
}

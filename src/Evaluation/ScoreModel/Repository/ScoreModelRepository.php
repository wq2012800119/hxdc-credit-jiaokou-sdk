<?php
namespace Sdk\Evaluation\ScoreModel\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Evaluation\ScoreModel\Adapter\ScoreModel\IScoreModelAdapter;
use Sdk\Evaluation\ScoreModel\Adapter\ScoreModel\ScoreModelMockAdapter;
use Sdk\Evaluation\ScoreModel\Adapter\ScoreModel\ScoreModelRestfulAdapter;

class ScoreModelRepository extends CommonRepository implements IScoreModelAdapter
{
    const LIST_MODEL_UN = 'SCORE_MODEL_LIST';
    const FETCH_ONE_MODEL_UN = 'SCORE_MODEL_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ScoreModelRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ScoreModelMockAdapter()
        );
    }
}

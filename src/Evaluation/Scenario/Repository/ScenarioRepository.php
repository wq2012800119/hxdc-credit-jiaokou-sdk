<?php
namespace Sdk\Evaluation\Scenario\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Evaluation\Scenario\Adapter\Scenario\IScenarioAdapter;
use Sdk\Evaluation\Scenario\Adapter\Scenario\ScenarioMockAdapter;
use Sdk\Evaluation\Scenario\Adapter\Scenario\ScenarioRestfulAdapter;

class ScenarioRepository extends CommonRepository implements IScenarioAdapter
{
    const LIST_MODEL_UN = 'SCENARIO_LIST';
    const FETCH_ONE_MODEL_UN = 'SCENARIO_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new ScenarioRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new ScenarioMockAdapter()
        );
    }
}

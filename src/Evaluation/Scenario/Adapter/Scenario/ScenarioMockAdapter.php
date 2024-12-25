<?php
namespace Sdk\Evaluation\Scenario\Adapter\Scenario;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Evaluation\Scenario\Model\Scenario;

//use Sdk\Evaluation\Scenario\Utils\MockObjectGenerate;

class ScenarioMockAdapter implements IScenarioAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Scenario($id);
        //return MockObjectGenerate::generateScenario($id);
    }
}

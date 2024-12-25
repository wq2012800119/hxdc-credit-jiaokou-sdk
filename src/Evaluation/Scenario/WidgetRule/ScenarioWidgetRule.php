<?php
namespace Sdk\Evaluation\Scenario\WidgetRule;

use Marmot\Core;
use Sdk\Common\WidgetRule\CommonWidgetRule;

class ScenarioWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function name($name) : bool
    {
        if (!$this->getCommonWidgetRule()->name($name)) {
            Core::setLastError(EVALUATION_SCENARIO_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function description($description) : bool
    {
        if (!$this->getCommonWidgetRule()->content($description)) {
            Core::setLastError(EVALUATION_SCENARIO_DESCRIPTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

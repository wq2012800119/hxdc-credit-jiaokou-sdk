<?php
namespace Sdk\Rap\Measure\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class MeasureWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function name($name) : bool
    {
        if (!$this->getCommonWidgetRule()->title($name)) {
            Core::setLastError(RAP_MEASURE_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function description($description) : bool
    {
        if (!$this->getCommonWidgetRule()->description($description)) {
            Core::setLastError(RAP_MEASURE_DESCRIPTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function implementationUnits($implementationUnits) : bool
    {
        if (!V::arrayType()->validate($implementationUnits)) {
            Core::setLastError(RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT);
            return false;
        }

        foreach ($implementationUnits as $implementationUnit) {
            if (!V::numeric()->positive()->validate($implementationUnit)) {
                Core::setLastError(RAP_MEASURE_IMPLEMENTATION_UNITS_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }
}

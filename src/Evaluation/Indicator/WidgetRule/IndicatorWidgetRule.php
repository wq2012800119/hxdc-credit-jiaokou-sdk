<?php
namespace Sdk\Evaluation\Indicator\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Evaluation\Indicator\Model\Indicator;

class IndicatorWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function name($name) : bool
    {
        if (!$this->getCommonWidgetRule()->title($name)) {
            Core::setLastError(EVALUATION_INDICATOR_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function infoCategory($infoCategory) : bool
    {
        if (!V::numeric()->positive()->validate($infoCategory)
            || !in_array($infoCategory, Indicator::INFO_CATEGORY)
        ) {
            Core::setLastError(EVALUATION_INDICATOR_INFO_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function category($category) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($category)
            || !in_array($category, Indicator::CATEGORY)
        ) {
            Core::setLastError(EVALUATION_INDICATOR_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function description($description) : bool
    {
        if (!$this->getCommonWidgetRule()->content($description)) {
            Core::setLastError(EVALUATION_INDICATOR_DESCRIPTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function sourceId($infoCategory, $sourceId) : bool
    {
        if (!$this->getCommonWidgetRule()->isNumericType($sourceId)) {
            Core::setLastError(EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT);
            return false;
        }

        if ($infoCategory == Indicator::INFO_CATEGORY['PRAISE'] ||
            $infoCategory == Indicator::INFO_CATEGORY['COMPLAINT']
        ) {
            if ($sourceId != 0) {
                Core::setLastError(EVALUATION_INDICATOR_SOURCE_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }
}

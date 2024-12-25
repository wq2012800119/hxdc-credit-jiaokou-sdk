<?php
namespace Sdk\Monitor\FocusMonitor\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Monitor\FocusMonitor\Model\FocusMonitor;

class FocusMonitorWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectCategory($subjectCategory) : bool
    {
        if (!V::numeric()->positive()->validate($subjectCategory)
            || !in_array($subjectCategory, FocusMonitor::SUBJECT_CATEGORY)
        ) {
            Core::setLastError(MONITOR_FOCUS_MONITOR_SUBJECT_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function identify($subjectCategory, $identify) : bool
    {
        if ($subjectCategory == FocusMonitor::SUBJECT_CATEGORY['ZRR']) {
            if (!$this->getCommonWidgetRule()->idCard($identify)) {
                Core::setLastError(MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        if ($subjectCategory != FocusMonitor::SUBJECT_CATEGORY['ZRR']) {
            if (!$this->getCommonWidgetRule()->unifiedIdentifier($identify)) {
                Core::setLastError(MONITOR_FOCUS_MONITOR_IDENTIFY_FORMAT_INCORRECT);
                return false;
            }
        }

        return true;
    }

    const PENALTY_THRESHOLD_MIN_VALUE = 1;
    const PENALTY_THRESHOLD_MAX_VALUE = 99999;
    public function penaltyThreshold($penaltyThreshold) : bool
    {
        if (!V::intVal()->between(
            self::PENALTY_THRESHOLD_MIN_VALUE,
            self::PENALTY_THRESHOLD_MAX_VALUE
        )->validate($penaltyThreshold)) {
            Core::setLastError(MONITOR_FOCUS_MONITOR_PENALTY_THRESHOLD_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const DISHONESTY_THRESHOLD_MIN_VALUE = 1;
    const DISHONESTY_THRESHOLD_MAX_VALUE = 99999;
    public function dishonestyThreshold($dishonestyThreshold) : bool
    {
        if (!V::intVal()->between(
            self::DISHONESTY_THRESHOLD_MIN_VALUE,
            self::DISHONESTY_THRESHOLD_MAX_VALUE
        )->validate($dishonestyThreshold)) {
            Core::setLastError(MONITOR_FOCUS_MONITOR_DISHONESTY_THRESHOLD_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

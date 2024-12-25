<?php
namespace Sdk\CreditModule\Financing\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class FinancingWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_FINANCING_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_FINANCING_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function financedAt($financedAt) : bool
    {
        if (!is_numeric($financedAt) || strtotime(date('Y-m-d H:i:s', $financedAt)) != $financedAt) {
            Core::setLastError(CM_FINANCING_FINANCED_AT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const STAGE_MIN_LENGTH = 1;
    const STAGE_MAX_LENGTH = 100;
    public function stage($stage) : bool
    {
        return $this->lengthWidgetRule(
            self::STAGE_MIN_LENGTH,
            self::STAGE_MAX_LENGTH,
            $stage,
            CM_FINANCING_STAGE_FORMAT_INCORRECT
        );
    }

    const AMOUNT_MIN_LENGTH = 1;
    const AMOUNT_MAX_LENGTH = 100;
    public function amount($amount) : bool
    {
        return $this->lengthWidgetRule(
            self::AMOUNT_MIN_LENGTH,
            self::AMOUNT_MAX_LENGTH,
            $amount,
            CM_FINANCING_AMOUNT_FORMAT_INCORRECT
        );
    }

    private function lengthWidgetRule(int $minLength, int $maxLength, string $parameter, string $errorCode) : bool
    {
        if (!V::stringType()->length($minLength, $maxLength)->validate($parameter)) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
    }
}

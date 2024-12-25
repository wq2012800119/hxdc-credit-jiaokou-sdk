<?php
namespace Sdk\CreditModule\Taxation\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class TaxationWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_TAXATION_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_TAXATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const IDENTIFICATION_NUMBER_MIN_LENGTH = 1;
    const IDENTIFICATION_NUMBER_MAX_LENGTH = 100;
    public function identificationNumber($identificationNumber) : bool
    {
        return $this->lengthWidgetRule(
            self::IDENTIFICATION_NUMBER_MIN_LENGTH,
            self::IDENTIFICATION_NUMBER_MAX_LENGTH,
            $identificationNumber,
            CM_TAXATION_IDENTIFICATION_NUMBER_FORMAT_INCORRECT
        );
    }

    const OUTSTANDING_TAX_BALANCE_MIN_LENGTH = 1;
    const OUTSTANDING_TAX_BALANCE_MAX_LENGTH = 100;
    public function outstandingTaxBalance($outstandingTaxBalance) : bool
    {
        return $this->lengthWidgetRule(
            self::OUTSTANDING_TAX_BALANCE_MIN_LENGTH,
            self::OUTSTANDING_TAX_BALANCE_MAX_LENGTH,
            $outstandingTaxBalance,
            CM_TAXATION_OUTSTANDING_TAX_BALANCE_FORMAT_INCORRECT
        );
    }

    const TOTAL_TAX_AMOUNT_MIN_LENGTH = 1;
    const TOTAL_TAX_AMOUNT_MAX_LENGTH = 100;
    public function totalTaxAmount($totalTaxAmount) : bool
    {
        return $this->lengthWidgetRule(
            self::TOTAL_TAX_AMOUNT_MIN_LENGTH,
            self::TOTAL_TAX_AMOUNT_MAX_LENGTH,
            $totalTaxAmount,
            CM_TAXATION_TOTAL_TAX_AMOUNT_FORMAT_INCORRECT
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

<?php
namespace Sdk\CreditModule\Collateral\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class CollateralWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_COLLATERAL_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_COLLATERAL_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const REGISTRATION_NUMBER_MIN_LENGTH = 1;
    const REGISTRATION_NUMBER_MAX_LENGTH = 100;
    public function registrationNumber($registrationNumber) : bool
    {
        return $this->lengthWidgetRule(
            self::REGISTRATION_NUMBER_MIN_LENGTH,
            self::REGISTRATION_NUMBER_MAX_LENGTH,
            $registrationNumber,
            CM_COLLATERAL_REGISTRATION_NUMBER_FORMAT_INCORRECT
        );
    }

    public function registrationDate($registrationDate) : bool
    {
        if (!is_numeric($registrationDate) || strtotime(date('Y-m-d H:i:s', $registrationDate)) != $registrationDate) {
            Core::setLastError(CM_COLLATERAL_REGISTRATION_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const REGISTRATION_AGENCY_MIN_LENGTH = 1;
    const REGISTRATION_AGENCY_MAX_LENGTH = 100;
    public function registrationAgency($registrationAgency) : bool
    {
        return $this->lengthWidgetRule(
            self::REGISTRATION_AGENCY_MIN_LENGTH,
            self::REGISTRATION_AGENCY_MAX_LENGTH,
            $registrationAgency,
            CM_COLLATERAL_REGISTRATION_AGENCY_FORMAT_INCORRECT
        );
    }

    const SECURED_BOND_AMOUNT_MIN_LENGTH = 1;
    const SECURED_BOND_AMOUNT_MAX_LENGTH = 100;
    public function securedBondAmount($securedBondAmount) : bool
    {
        return $this->lengthWidgetRule(
            self::SECURED_BOND_AMOUNT_MIN_LENGTH,
            self::SECURED_BOND_AMOUNT_MAX_LENGTH,
            $securedBondAmount,
            CM_COLLATERAL_SECURED_BOND_AMOUNT_FORMAT_INCORRECT
        );
    }

    const MORTGAGE_STATUS_MIN_LENGTH = 1;
    const MORTGAGE_STATUS_MAX_LENGTH = 100;
    public function mortgageStatus($mortgageStatus) : bool
    {
        return $this->lengthWidgetRule(
            self::MORTGAGE_STATUS_MIN_LENGTH,
            self::MORTGAGE_STATUS_MAX_LENGTH,
            $mortgageStatus,
            CM_COLLATERAL_MORTGAGE_STATUS_FORMAT_INCORRECT
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

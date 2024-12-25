<?php
namespace Sdk\CreditModule\Copyright\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class CopyrightWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_COPYRIGHT_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_COPYRIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 100;
    public function title($title) : bool
    {
        return $this->lengthWidgetRule(
            self::TITLE_MIN_LENGTH,
            self::TITLE_MAX_LENGTH,
            $title,
            CM_COPYRIGHT_TITLE_FORMAT_INCORRECT
        );
    }

    const REGISTRATION_NUMBER_MIN_LENGTH = 1;
    const REGISTRATION_NUMBER_MAX_LENGTH = 100;
    public function registrationNumber($registrationNumber) : bool
    {
        return $this->lengthWidgetRule(
            self::REGISTRATION_NUMBER_MIN_LENGTH,
            self::REGISTRATION_NUMBER_MAX_LENGTH,
            $registrationNumber,
            CM_COPYRIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT
        );
    }

    const CONDITIONS_MIN_LENGTH = 1;
    const CONDITIONS_MAX_LENGTH = 100;
    public function conditions($conditions) : bool
    {
        return $this->lengthWidgetRule(
            self::CONDITIONS_MIN_LENGTH,
            self::CONDITIONS_MAX_LENGTH,
            $conditions,
            CM_COPYRIGHT_CONDITIONS_FORMAT_INCORRECT
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

    public function registrationDate($registrationDate) : bool
    {
        if (!is_numeric($registrationDate) || strtotime(date('Y-m-d H:i:s', $registrationDate)) != $registrationDate) {
            Core::setLastError(CM_COPYRIGHT_REGISTRATION_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

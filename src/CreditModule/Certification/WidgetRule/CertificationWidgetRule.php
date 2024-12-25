<?php
namespace Sdk\CreditModule\Certification\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class CertificationWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_CERTIFICATION_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_CERTIFICATION_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const NAME_MIN_LENGTH = 1;
    const NAME_MAX_LENGTH = 100;
    public function name($name) : bool
    {
        return $this->lengthWidgetRule(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $name,
            CM_CERTIFICATION_NAME_FORMAT_INCORRECT
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

    public function pubDate($pubDate) : bool
    {
        if (!is_numeric($pubDate) || strtotime(date('Y-m-d H:i:s', $pubDate)) != $pubDate) {
            Core::setLastError(CM_CERTIFICATION_PUB_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function validateDate($validateDate) : bool
    {
        if (!is_numeric($validateDate) || strtotime(date('Y-m-d H:i:s', $validateDate)) != $validateDate) {
            Core::setLastError(CM_CERTIFICATION_VALIDATE_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

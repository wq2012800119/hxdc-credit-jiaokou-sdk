<?php
namespace Sdk\CreditModule\SoftwareRight\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class SoftwareRightWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_SOFTWARERIGHT_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_SOFTWARERIGHT_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
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
            CM_SOFTWARERIGHT_TITLE_FORMAT_INCORRECT
        );
    }

    const VERSION_MIN_LENGTH = 1;
    const VERSION_MAX_LENGTH = 100;
    public function version($version) : bool
    {
        return $this->lengthWidgetRule(
            self::VERSION_MIN_LENGTH,
            self::VERSION_MAX_LENGTH,
            $version,
            CM_SOFTWARERIGHT_VERSION_FORMAT_INCORRECT
        );
    }

    const CATEGORY_MIN_LENGTH = 1;
    const CATEGORY_MAX_LENGTH = 100;
    public function category($category) : bool
    {
        return $this->lengthWidgetRule(
            self::CATEGORY_MIN_LENGTH,
            self::CATEGORY_MAX_LENGTH,
            $category,
            CM_SOFTWARERIGHT_CATEGORY_FORMAT_INCORRECT
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
            CM_SOFTWARERIGHT_REGISTRATION_NUMBER_FORMAT_INCORRECT
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

    public function registrationApprovalDate($registrationApprovalDate) : bool
    {
        if (!is_numeric($registrationApprovalDate)
            || strtotime(date('Y-m-d H:i:s', $registrationApprovalDate))
            != $registrationApprovalDate) {
            Core::setLastError(CM_SOFTWARERIGHT_REGISTRATION_APPROVAL_DATE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

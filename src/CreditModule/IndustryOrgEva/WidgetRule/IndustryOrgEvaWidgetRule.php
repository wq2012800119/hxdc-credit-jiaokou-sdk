<?php
namespace Sdk\CreditModule\IndustryOrgEva\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class IndustryOrgEvaWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function subjectName($subjectName) : bool
    {
        if (!$this->getCommonWidgetRule()->subjectName($subjectName)) {
            Core::setLastError(CM_INDUSTRYORGEVA_SUBJECT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function unifiedIdentifier($unifiedIdentifier) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($unifiedIdentifier)) {
            Core::setLastError(CM_INDUSTRYORGEVA_UNIFIED_IDENTIFIER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const INDUSTRY_NAME_MIN_LENGTH = 1;
    const INDUSTRY_NAME_MAX_LENGTH = 100;
    public function industryName($industryName) : bool
    {
        return $this->lengthWidgetRule(
            self::INDUSTRY_NAME_MIN_LENGTH,
            self::INDUSTRY_NAME_MAX_LENGTH,
            $industryName,
            CM_INDUSTRYORGEVA_INDUSTRY_NAME_FORMAT_INCORRECT
        );
    }

    const EVALUATION_TYPE_MIN_LENGTH = 1;
    const EVALUATION_TYPE_MAX_LENGTH = 100;
    public function evaluationType($evaluationType) : bool
    {
        return $this->lengthWidgetRule(
            self::EVALUATION_TYPE_MIN_LENGTH,
            self::EVALUATION_TYPE_MAX_LENGTH,
            $evaluationType,
            CM_INDUSTRYORGEVA_EVALUATION_TYPE_FORMAT_INCORRECT
        );
    }

    const EVALUATION_CONTENT_MIN_LENGTH = 1;
    const EVALUATION_CONTENT_MAX_LENGTH = 512;
    public function evaluationContent($evaluationContent) : bool
    {
        return $this->lengthWidgetRule(
            self::EVALUATION_CONTENT_MIN_LENGTH,
            self::EVALUATION_CONTENT_MAX_LENGTH,
            $evaluationContent,
            CM_INDUSTRYORGEVA_EVALUATION_CONTENT_FORMAT_INCORRECT
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

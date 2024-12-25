<?php
namespace Sdk\Rap\RapCase\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Rap\RapCase\Model\RapCase;

class RapCaseWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function zjlx($zjlx) : bool
    {
        if (!V::numeric()->positive()->validate($zjlx)
            || !in_array($zjlx, RapCase::ZJLX)
        ) {
            Core::setLastError(RAP_CASE_ZJLX_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const SJJE_MIN_LENGTH = 1;
    const SJJE_MAX_LENGTH = 20;
    public function sjje($sjje) : bool
    {
        return $this->lengthWidgetRule(
            self::SJJE_MIN_LENGTH,
            self::SJJE_MAX_LENGTH,
            $sjje,
            RAP_CASE_SJJE_FORMAT_INCORRECT
        );
    }

    const JCSM_MIN_LENGTH = 1;
    const JCSM_MAX_LENGTH = 2000;
    public function jcsm($jcsm) : bool
    {
        return $this->lengthWidgetRule(
            self::JCSM_MIN_LENGTH,
            self::JCSM_MAX_LENGTH,
            $jcsm,
            RAP_CASE_JCSM_FORMAT_INCORRECT
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

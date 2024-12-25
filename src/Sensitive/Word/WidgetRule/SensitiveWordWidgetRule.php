<?php
namespace Sdk\Sensitive\Word\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

class SensitiveWordWidgetRule
{
    const NAME_MIN_LENGTH = 2;
    const NAME_MAX_LENGTH = 40;
    public function name($name) : bool
    {
        if (!V::stringType()->length(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH
        )->validate($name)) {
            Core::setLastError(SENSITIVE_WORD_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const SOURCE_MIN_LENGTH = 1;
    const SOURCE_MAX_LENGTH = 20;
    public function source($source) : bool
    {
        if (!V::stringType()->length(
            self::SOURCE_MIN_LENGTH,
            self::SOURCE_MAX_LENGTH
        )->validate($source)) {
            Core::setLastError(SENSITIVE_WORD_SOURCE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const REMARK_MIN_LENGTH = 1;
    const REMARK_MAX_LENGTH = 200;
    public function remark($remark) : bool
    {
        if (!V::stringType()->length(
            self::REMARK_MIN_LENGTH,
            self::REMARK_MAX_LENGTH
        )->validate($remark)) {
            Core::setLastError(SENSITIVE_WORD_REMARK_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

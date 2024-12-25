<?php
namespace Sdk\Organization\Organization\WidgetRule;

use Marmot\Core;

use Respect\Validation\Validator as V;

class OrganizationWidgetRule
{
    const SHORT_NAME_MIN_LENGTH = 1;
    const SHORT_NAME_MAX_LENGTH = 10;
    //验证简称长度：1-10个字符
    public function shortName($shortName) : bool
    {
        if (!V::stringType()->length(self::SHORT_NAME_MIN_LENGTH, self::SHORT_NAME_MAX_LENGTH)->validate($shortName)) {
            Core::setLastError(ORGANIZATION_SHORT_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

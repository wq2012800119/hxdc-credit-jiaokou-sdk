<?php
namespace Sdk\Monitor\Opinion\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Monitor\Opinion\Model\Opinion;

class OpinionWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function name($name) : bool
    {
        if (!$this->getCommonWidgetRule()->title($name)) {
            Core::setLastError(MONITOR_OPINION_NAME_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const KEYWORD_MIN_LENGTH = 1;
    const KEYWORD_MAX_LENGTH = 200;
    public function keyword($keyword) : bool
    {
        return $this->lengthWidgetRule(
            self::KEYWORD_MIN_LENGTH,
            self::KEYWORD_MAX_LENGTH,
            $keyword,
            MONITOR_OPINION_KEYWORD_FORMAT_INCORRECT
        );
    }

    public function category($category) : bool
    {
        if (!V::numeric()->validate($category)
            || !in_array($category, Opinion::CATEGORY)
        ) {
            Core::setLastError(MONITOR_OPINION_CATEGORY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function source($source) : bool
    {
        if (!V::numeric()->positive()->validate($source)
            || !in_array($source, Opinion::SOURCE)
        ) {
            Core::setLastError(MONITOR_OPINION_SOURCE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function pubDate($pubDate) :bool
    {
        return $this->unixTimeStampWidgetRule($pubDate, MONITOR_OPINION_PUB_DATE_FORMAT_INCORRECT);
    }

    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 2000;
    public function content($content) : bool
    {
        return $this->lengthWidgetRule(
            self::CONTENT_MIN_LENGTH,
            self::CONTENT_MAX_LENGTH,
            $content,
            MONITOR_OPINION_CONTENT_FORMAT_INCORRECT
        );
    }

    private function unixTimeStampWidgetRule(string $parameter, string $errorCode) : bool
    {
        if (strtotime(date('m-d-Y H:i:s', $parameter)) === $parameter) {
            Core::setLastError($errorCode);
            return false;
        }

        return true;
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

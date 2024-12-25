<?php
namespace Sdk\Interaction\CommonInteraction\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class InteractionWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }
    
    public function cellphone($cellphone) : bool
    {
        if (!$this->getCommonWidgetRule()->cellphone($cellphone)) {
            Core::setLastError(INTERACTION_CELLPHONE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function question($question) : bool
    {
        if (!$this->getCommonWidgetRule()->title($question)) {
            Core::setLastError(INTERACTION_QUESTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 200;
    //验证内容长度：1-200个字符
    public function content($content) : bool
    {
        if (!V::stringType()->length(
            self::CONTENT_MIN_LENGTH,
            self::CONTENT_MAX_LENGTH
        )->validate($content)) {
            Core::setLastError(INTERACTION_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const REPLY_CONTENT_MIN_LENGTH = 1;
    const REPLY_CONTENT_MAX_LENGTH = 2000;
    //验证回复内容长度：1-2000个字符
    public function replyContent($replyContent) : bool
    {
        if (!V::stringType()->length(
            self::REPLY_CONTENT_MIN_LENGTH,
            self::REPLY_CONTENT_MAX_LENGTH
        )->validate($replyContent)) {
            Core::setLastError(INTERACTION_REPLY_CONTENT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const EVIDENCES_MAX_COUNT = 5;
    //佐证材料: 最多可上传5个文件, 格式: png, jpg, jpeg
    public function evidences($evidences) : bool
    {
        if (!V::arrayType()->validate($evidences)) {
            Core::setLastError(INTERACTION_EVIDENCES_FORMAT_INCORRECT);
            return false;
        }

        if (count($evidences) > self::EVIDENCES_MAX_COUNT) {
            Core::setLastError(INTERACTION_EVIDENCES_EXCEED_MAX_LIMIT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->pictures($evidences)) {
            Core::setLastError(INTERACTION_EVIDENCES_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

<?php
namespace Sdk\User\Member\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\User\Member\Model\Member;

class MemberWidgetRule
{
    public function gender($gender) : bool
    {
        if (!V::numeric()->positive()->validate($gender) || !in_array($gender, Member::GENDER)) {
            Core::setLastError(MEMBER_GENDER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function email($email) : bool
    {
        if (!V::email()->validate($email)) {
            Core::setLastError(MEMBER_EMAIL_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ADDRESS_MIN_LENGTH = 1;
    const ADDRESS_MAX_LENGTH = 200;
    //验证地址长度：1-200个字符
    public function address($address) : bool
    {
        if (!V::stringType()->length(
            self::ADDRESS_MIN_LENGTH,
            self::ADDRESS_MAX_LENGTH
        )->validate($address)) {
            Core::setLastError(MEMBER_ADDRESS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function question($question) : bool
    {
        if (!V::numeric()->positive()->validate($question) || !in_array($question, Member::QUESTION)) {
            Core::setLastError(MEMBER_QUESTION_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ANSWER_MIN_LENGTH = 1;
    const ANSWER_MAX_LENGTH = 20;
    //验证密保答案长度：1-20个字符
    public function answer($answer) : bool
    {
        if (!V::stringType()->length(
            self::ANSWER_MIN_LENGTH,
            self::ANSWER_MAX_LENGTH
        )->validate($answer)) {
            Core::setLastError(MEMBER_ANSWER_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

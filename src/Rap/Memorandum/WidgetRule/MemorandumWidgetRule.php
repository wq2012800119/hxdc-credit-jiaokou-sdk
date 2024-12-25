<?php
namespace Sdk\Rap\Memorandum\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Rap\Memorandum\Model\Memorandum;

class MemorandumWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const NAME_MIN_LENGTH = 1;
    const NAME_MAX_LENGTH = 200;
    public function name($name) : bool
    {
        return $this->lengthWidgetRule(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $name,
            RAP_MEMORANDUM_NAME_FORMAT_INCORRECT
        );
    }

    const DOCUMENT_NO_MIN_LENGTH = 1;
    const DOCUMENT_NO_MAX_LENGTH = 20;
    public function documentNo($documentNo) : bool
    {
        return $this->lengthWidgetRule(
            self::DOCUMENT_NO_MIN_LENGTH,
            self::DOCUMENT_NO_MAX_LENGTH,
            $documentNo,
            RAP_MEMORANDUM_DOCUMENT_NO_FORMAT_INCORRECT
        );
    }

    const ORIGINATING_UNIT_MIN_LENGTH = 1;
    const ORIGINATING_UNIT_MAX_LENGTH = 200;
    public function originatingUnit($originatingUnit) : bool
    {
        return $this->lengthWidgetRule(
            self::ORIGINATING_UNIT_MIN_LENGTH,
            self::ORIGINATING_UNIT_MAX_LENGTH,
            $originatingUnit,
            RAP_MEMORANDUM_ORIGINATING_UNIT_FORMAT_INCORRECT
        );
    }

    public function releaseDate($releaseDate) :bool
    {
        return $this->unixTimeStampWidgetRule($releaseDate, RAP_MEMORANDUM_RELEASE_DATE_FORMAT_INCORRECT);
    }

    public function rewardType($rewardType) : bool
    {
        if (!V::numeric()->positive()->validate($rewardType)
            || !in_array($rewardType, Memorandum::REWARD_TYPE)
        ) {
            Core::setLastError(RAP_MEMORANDUM_REWARD_TYPE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const JOINT_SIGNING_DEPARTMENT_MIN_LENGTH = 1;
    const JOINT_SIGNING_DEPARTMENT_MAX_LENGTH = 2000;
    public function jointSigningDepartment($jointSigningDepartment) : bool
    {
        return $this->lengthWidgetRule(
            self::JOINT_SIGNING_DEPARTMENT_MIN_LENGTH,
            self::JOINT_SIGNING_DEPARTMENT_MAX_LENGTH,
            $jointSigningDepartment,
            RAP_MEMORANDUM_JOINT_SIGNING_DEPARTMENT_FORMAT_INCORRECT
        );
    }

    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 2000;
    public function content($content) : bool
    {
        return $this->lengthWidgetRule(
            self::CONTENT_MIN_LENGTH,
            self::CONTENT_MAX_LENGTH,
            $content,
            RAP_MEMORANDUM_CONTENT_FORMAT_INCORRECT
        );
    }

    const ATTACHMENTS_MAX_COUNT = 5;
    //附件: 最多可上传5个文件, 格式: doc、docx、xls、xlsx、pdf、zip、rar、lzh、jar、ppt、txt
    public function attachments($attachments) : bool
    {
        if (!V::arrayType()->validate($attachments)) {
            Core::setLastError(RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        if (count($attachments) > self::ATTACHMENTS_MAX_COUNT) {
            Core::setLastError(RAP_MEMORANDUM_ATTACHMENTS_COUNT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->attachments($attachments)) {
            Core::setLastError(RAP_MEMORANDUM_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        return true;
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

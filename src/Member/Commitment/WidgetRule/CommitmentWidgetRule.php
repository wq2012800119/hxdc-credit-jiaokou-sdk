<?php
namespace Sdk\Member\Commitment\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Member\Commitment\Model\Commitment;

class CommitmentWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function certificateType($certificateType) : bool
    {
        if (!V::numeric()->positive()->validate($certificateType) ||
            !in_array($certificateType, Commitment::CERTIFICATE_TYPE)
        ) {
            Core::setLastError(SELF_DECLARATION_CERTIFICATE_TYPE_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ATTACHMENTS_MAX_COUNT = 5;
    //附件: 最多可上传5个文件, 格式: png, jpg, jpeg
    public function attachments($attachments) : bool
    {
        if (!V::arrayType()->validate($attachments)) {
            Core::setLastError(SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        if (count($attachments) > self::ATTACHMENTS_MAX_COUNT) {
            Core::setLastError(SELF_DECLARATION_ATTACHMENTS_COUNT_FORMAT_INCORRECT);
            return false;
        }

        if (!$this->getCommonWidgetRule()->attachments($attachments)) {
            Core::setLastError(SELF_DECLARATION_ATTACHMENTS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

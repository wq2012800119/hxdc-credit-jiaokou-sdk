<?php
namespace Sdk\Member\NaturalPersonCertificate\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

class NaturalPersonCertificateWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    public function frontIdCardPic($frontIdCardPic) : bool
    {
        if (!$this->getCommonWidgetRule()->validatePictureExtension($frontIdCardPic)) {
            Core::setLastError(NATURAL_PERSON_CERTIFICATE_FRONT_ID_CARD_PIC_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function backIdCardPic($backIdCardPic) : bool
    {
        if (!$this->getCommonWidgetRule()->validatePictureExtension($backIdCardPic)) {
            Core::setLastError(NATURAL_PERSON_CERTIFICATE_BACK_ID_CARD_PIC_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function handheldIdCardPic($handheldIdCardPic) : bool
    {
        if (!$this->getCommonWidgetRule()->validatePictureExtension($handheldIdCardPic)) {
            Core::setLastError(NATURAL_PERSON_CERTIFICATE_HANDHELD_ID_CARD_PIC_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
}

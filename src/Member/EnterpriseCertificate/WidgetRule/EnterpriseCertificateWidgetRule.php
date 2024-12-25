<?php
namespace Sdk\Member\EnterpriseCertificate\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Member\EnterpriseCertificate\Model\EnterpriseCertificate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.ShortMethodName)
 */
class EnterpriseCertificateWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const ZTMC_MIN_LENGTH = 1;
    const ZTMC_MAX_LENGTH = 200;
    public function ztmc($ztmc) : bool
    {
        return $this->lengthWidgetRule(
            self::ZTMC_MIN_LENGTH,
            self::ZTMC_MAX_LENGTH,
            $ztmc,
            ENTERPRISE_CERTIFICATE_ZTMC_FORMAT_INCORRECT
        );
    }

    public function ztlb($ztlb) : bool
    {
        if (!V::numeric()->positive()->validate($ztlb) || !in_array($ztlb, EnterpriseCertificate::ZTLB)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_ZTLB_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function tyshxydm($tyshxydm) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($tyshxydm)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_TYSHXYDM_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const FDDBR_MIN_LENGTH = 1;
    const FDDBR_MAX_LENGTH = 100;
    public function fddbr($fddbr) : bool
    {
        return $this->lengthWidgetRule(
            self::FDDBR_MIN_LENGTH,
            self::FDDBR_MAX_LENGTH,
            $fddbr,
            ENTERPRISE_CERTIFICATE_FDDBR_FORMAT_INCORRECT
        );
    }

    public function fddbrzjlx($fddbrzjlx) : bool
    {
        if (!in_array($fddbrzjlx, EnterpriseCertificate::FDDBRZJLX)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_FDDBRZJLX_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const FDDBRZJHM_MIN_LENGTH = 1;
    const FDDBRZJHM_MAX_LENGTH = 64;
    public function fddbrzjhm($fddbrzjlx, $fddbrzjhm) : bool
    {
        if ($fddbrzjlx == EnterpriseCertificate::FDDBRZJLX['JMSFZ'] ||
            $fddbrzjlx == EnterpriseCertificate::FDDBRZJLX['LSJMSFZ']
        ) {
            if (!$this->getCommonWidgetRule()->idCard($fddbrzjhm)) {
                Core::setLastError(ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT);
                return false;
            }

            return true;
        }

        if ($fddbrzjlx != EnterpriseCertificate::FDDBRZJLX['JMSFZ'] &&
            $fddbrzjlx != EnterpriseCertificate::FDDBRZJLX['LSJMSFZ']
        ) {
            return $this->lengthWidgetRule(
                self::FDDBRZJHM_MIN_LENGTH,
                self::FDDBRZJHM_MAX_LENGTH,
                $fddbrzjhm,
                ENTERPRISE_CERTIFICATE_FDDBRZJHM_FORMAT_INCORRECT
            );
        }

        return false;
    }

    public function clrq($clrq) :bool
    {
        return $this->unixTimeStampWidgetRule($clrq, ENTERPRISE_CERTIFICATE_CLRQ_FORMAT_INCORRECT);
    }

    public function yxq($yxq) :bool
    {
        return $this->unixTimeStampWidgetRule($yxq, ENTERPRISE_CERTIFICATE_YXQ_FORMAT_INCORRECT);
    }

    const DZ_MIN_LENGTH = 1;
    const DZ_MAX_LENGTH = 200;
    public function dz($dz) : bool
    {
        return $this->lengthWidgetRule(
            self::DZ_MIN_LENGTH,
            self::DZ_MAX_LENGTH,
            $dz,
            ENTERPRISE_CERTIFICATE_DZ_FORMAT_INCORRECT
        );
    }

    const DJJG_MIN_LENGTH = 1;
    const DJJG_MAX_LENGTH = 200;
    public function djjg($djjg) : bool
    {
        return $this->lengthWidgetRule(
            self::DJJG_MIN_LENGTH,
            self::DJJG_MAX_LENGTH,
            $djjg,
            ENTERPRISE_CERTIFICATE_DJJG_FORMAT_INCORRECT
        );
    }

    const GB_MIN_LENGTH = 1;
    const GB_MAX_LENGTH = 3;
    public function gb($gb) : bool
    {
        return $this->lengthWidgetRule(
            self::GB_MIN_LENGTH,
            self::GB_MAX_LENGTH,
            $gb,
            ENTERPRISE_CERTIFICATE_GB_FORMAT_INCORRECT
        );
    }

    public function zczb($zczb) : bool
    {
        if (!$this->getCommonWidgetRule()->isStringType($zczb)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_ZCZB_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }
    
    const ZCZBBZ_MIN_LENGTH = 0;
    const ZCZBBZ_MAX_LENGTH = 10;
    public function zczbbz($zczbbz) : bool
    {
        return $this->lengthWidgetRule(
            self::ZCZBBZ_MIN_LENGTH,
            self::ZCZBBZ_MAX_LENGTH,
            $zczbbz,
            ENTERPRISE_CERTIFICATE_ZCZBBZ_FORMAT_INCORRECT
        );
    }

    public function hydm($hydm) : bool
    {
        if (!in_array($hydm, EnterpriseCertificate::HYDM)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_HYDM_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function lx($lx) : bool
    {
        if (!array_key_exists($lx, EnterpriseCertificate::LX_CN)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_LX_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const JYFW_MIN_LENGTH = 1;
    const JYFW_MAX_LENGTH = 2000;
    public function jyfw($jyfw) : bool
    {
        return $this->lengthWidgetRule(
            self::JYFW_MIN_LENGTH,
            self::JYFW_MAX_LENGTH,
            $jyfw,
            ENTERPRISE_CERTIFICATE_JYFW_FORMAT_INCORRECT
        );
    }

    public function jyzt($jyzt) : bool
    {
        if (!V::numeric()->positive()->validate($jyzt) || !in_array($jyzt, EnterpriseCertificate::JYZT)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_JYZT_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const JYFWMS_MIN_LENGTH = 1;
    const JYFWMS_MAX_LENGTH = 2000;
    public function jyfwms($jyfwms) : bool
    {
        return $this->lengthWidgetRule(
            self::JYFWMS_MIN_LENGTH,
            self::JYFWMS_MAX_LENGTH,
            $jyfwms,
            ENTERPRISE_CERTIFICATE_JYFWMS_FORMAT_INCORRECT
        );
    }

    public function businessLicensePicture($businessLicensePicture) : bool
    {
        if (!$this->getCommonWidgetRule()->validatePictureExtension($businessLicensePicture)) {
            Core::setLastError(ENTERPRISE_CERTIFICATE_BUSINESS_LICENSE_PICTURE_FORMAT_INCORRECT);
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

<?php
namespace Sdk\Contract\WidgetRule;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\WidgetRule\CommonWidgetRule;

use Sdk\Contract\Performance\Model\Performance;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class ContractWidgetRule
{
    protected function getCommonWidgetRule() : CommonWidgetRule
    {
        return new CommonWidgetRule();
    }

    const HTBH_MIN_LENGTH = 1;
    const HTBH_MAX_LENGTH = 100;
    public function htbh($htbh) : bool
    {
        return $this->lengthWidgetRule(
            self::HTBH_MIN_LENGTH,
            self::HTBH_MAX_LENGTH,
            $htbh,
            CONTRACT_PERFORMANCE_HTBH_FORMAT_INCORRECT
        );
    }

    const HTMC_MIN_LENGTH = 1;
    const HTMC_MAX_LENGTH = 200;
    public function htmc($htmc) : bool
    {
        return $this->lengthWidgetRule(
            self::HTMC_MIN_LENGTH,
            self::HTMC_MAX_LENGTH,
            $htmc,
            CONTRACT_PERFORMANCE_HTMC_FORMAT_INCORRECT
        );
    }

    public function htlx($htlx) : bool
    {
        if (!V::numeric()->positive()->validate($htlx) || !in_array($htlx, Performance::HTLX)
        ) {
            Core::setLastError(CONTRACT_PERFORMANCE_HTLX_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const XMBH_MIN_LENGTH = 1;
    const XMBH_MAX_LENGTH = 100;
    public function xmbh($xmbh) : bool
    {
        return $this->lengthWidgetRule(
            self::XMBH_MIN_LENGTH,
            self::XMBH_MAX_LENGTH,
            $xmbh,
            CONTRACT_PERFORMANCE_XMBH_FORMAT_INCORRECT
        );
    }

    const CGR_MIN_LENGTH = 1;
    const CGR_MAX_LENGTH = 200;
    public function cgr($cgr) : bool
    {
        return $this->lengthWidgetRule(
            self::CGR_MIN_LENGTH,
            self::CGR_MAX_LENGTH,
            $cgr,
            CONTRACT_PERFORMANCE_CGR_FORMAT_INCORRECT
        );
    }

    public function jfzttyshxydm($jfzttyshxydm) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($jfzttyshxydm)) {
            Core::setLastError(CONTRACT_PERFORMANCE_JFZTTYSHXYDM_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const CGRDZ_MIN_LENGTH = 1;
    const CGRDZ_MAX_LENGTH = 200;
    public function cgrdz($cgrdz) : bool
    {
        return $this->lengthWidgetRule(
            self::CGRDZ_MIN_LENGTH,
            self::CGRDZ_MAX_LENGTH,
            $cgrdz,
            CONTRACT_PERFORMANCE_CGRDZ_FORMAT_INCORRECT
        );
    }

    const GYS_MIN_LENGTH = 1;
    const GYS_MAX_LENGTH = 200;
    public function gys($gys) : bool
    {
        return $this->lengthWidgetRule(
            self::GYS_MIN_LENGTH,
            self::GYS_MAX_LENGTH,
            $gys,
            CONTRACT_PERFORMANCE_GYS_FORMAT_INCORRECT
        );
    }

    public function yftyshxydm($yftyshxydm) : bool
    {
        if (!$this->getCommonWidgetRule()->unifiedIdentifier($yftyshxydm)) {
            Core::setLastError(CONTRACT_PERFORMANCE_YFTYSHXYDM_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const GYSDZ_MIN_LENGTH = 1;
    const GYSDZ_MAX_LENGTH = 200;
    public function gysdz($gysdz) : bool
    {
        return $this->lengthWidgetRule(
            self::GYSDZ_MIN_LENGTH,
            self::GYSDZ_MAX_LENGTH,
            $gysdz,
            CONTRACT_PERFORMANCE_GYSDZ_FORMAT_INCORRECT
        );
    }

    public function gyslxfs($gyslxfs) : bool
    {
        if (!$this->getCommonWidgetRule()->cellphone($gyslxfs)) {
            Core::setLastError(CONTRACT_PERFORMANCE_GYSLXFS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const ZYBDMC_MIN_LENGTH = 1;
    const ZYBDMC_MAX_LENGTH = 200;
    public function zybdmc($zybdmc) : bool
    {
        return $this->lengthWidgetRule(
            self::ZYBDMC_MIN_LENGTH,
            self::ZYBDMC_MAX_LENGTH,
            $zybdmc,
            CONTRACT_PERFORMANCE_ZYBDMC_FORMAT_INCORRECT
        );
    }

    const GGXH_MIN_LENGTH = 1;
    const GGXH_MAX_LENGTH = 200;
    public function ggxh($ggxh) : bool
    {
        return $this->lengthWidgetRule(
            self::GGXH_MIN_LENGTH,
            self::GGXH_MAX_LENGTH,
            $ggxh,
            CONTRACT_PERFORMANCE_GGXH_FORMAT_INCORRECT
        );
    }

    const ZYBDSL_MIN_LENGTH = 1;
    const ZYBDSL_MAX_LENGTH = 200;
    public function zybdsl($zybdsl) : bool
    {
        return $this->lengthWidgetRule(
            self::ZYBDSL_MIN_LENGTH,
            self::ZYBDSL_MAX_LENGTH,
            $zybdsl,
            CONTRACT_PERFORMANCE_ZYBDSL_FORMAT_INCORRECT
        );
    }

    const ZYBDDJ_MIN_LENGTH = 1;
    const ZYBDDJ_MAX_LENGTH = 10;
    public function zybddj($zybddj) : bool
    {
        return $this->lengthWidgetRule(
            self::ZYBDDJ_MIN_LENGTH,
            self::ZYBDDJ_MAX_LENGTH,
            $zybddj,
            CONTRACT_PERFORMANCE_ZYBDDJ_FORMAT_INCORRECT
        );
    }

    const HTJE_MIN_LENGTH = 1;
    const HTJE_MAX_LENGTH = 10;
    public function htje($htje) : bool
    {
        return $this->lengthWidgetRule(
            self::HTJE_MIN_LENGTH,
            self::HTJE_MAX_LENGTH,
            $htje,
            CONTRACT_PERFORMANCE_HTJE_FORMAT_INCORRECT
        );
    }

    public function lyqx($lyqx, $htqdrq) :bool
    {
        if (!$this->unixTimeStampWidgetRule($lyqx, CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT)
         || !$this->unixTimeStampWidgetRule($htqdrq, CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT)
         || $lyqx <= $htqdrq) {
            Core::setLastError(CONTRACT_PERFORMANCE_LYQX_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const QZDD_MIN_LENGTH = 1;
    const QZDD_MAX_LENGTH = 200;
    public function qzdd($qzdd) : bool
    {
        return $this->lengthWidgetRule(
            self::QZDD_MIN_LENGTH,
            self::QZDD_MAX_LENGTH,
            $qzdd,
            CONTRACT_PERFORMANCE_QZDD_FORMAT_INCORRECT
        );
    }

    public function cgfs($cgfs) : bool
    {
        if (!V::numeric()->positive()->validate($cgfs) || !in_array($cgfs, Performance::CGFS)
        ) {
            Core::setLastError(CONTRACT_PERFORMANCE_CGFS_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function htqdrq($htqdrq) :bool
    {
        if (!$this->unixTimeStampWidgetRule($htqdrq, CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT)
         || $htqdrq >= time()) {
            Core::setLastError(CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    public function htggrq($htggrq, $htqdrq) :bool
    {
        if (!$this->unixTimeStampWidgetRule($htggrq, CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT)
         || !$this->unixTimeStampWidgetRule($htqdrq, CONTRACT_PERFORMANCE_HTQDRQ_FORMAT_INCORRECT)
         || $htggrq < $htqdrq) {
            Core::setLastError(CONTRACT_PERFORMANCE_HTGGRQ_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const QTBCSY_MIN_LENGTH = 1;
    const QTBCSY_MAX_LENGTH = 500;
    public function qtbcsy($qtbcsy) : bool
    {
        return $this->lengthWidgetRule(
            self::QTBCSY_MIN_LENGTH,
            self::QTBCSY_MAX_LENGTH,
            $qtbcsy,
            CONTRACT_PERFORMANCE_QTBCSY_FORMAT_INCORRECT
        );
    }

    const LYZT_MIN_LENGTH = 1;
    const LYZT_MAX_LENGTH = 100;
    public function lyzt($lyzt) : bool
    {
        return $this->lengthWidgetRule(
            self::LYZT_MIN_LENGTH,
            self::LYZT_MAX_LENGTH,
            $lyzt,
            CONTRACT_PERFORMANCE_LYZT_FORMAT_INCORRECT
        );
    }

    const SSQY_MIN_LENGTH = 1;
    const SSQY_MAX_LENGTH = 100;
    public function ssqy($ssqy) : bool
    {
        return $this->lengthWidgetRule(
            self::SSQY_MIN_LENGTH,
            self::SSQY_MAX_LENGTH,
            $ssqy,
            CONTRACT_PERFORMANCE_SSQY_FORMAT_INCORRECT
        );
    }

    public function sshy($sshy) : bool
    {
        if (!V::numeric()->positive()->validate($sshy) || !in_array($sshy, Performance::SSHY)
        ) {
            Core::setLastError(CONTRACT_PERFORMANCE_SSHY_FORMAT_INCORRECT);
            return false;
        }

        return true;
    }

    const HTZXJD_MIN_LENGTH = 1;
    const HTZXJD_MAX_LENGTH = 200;
    public function htzxjd($htzxjd) : bool
    {
        return $this->lengthWidgetRule(
            self::HTZXJD_MIN_LENGTH,
            self::HTZXJD_MAX_LENGTH,
            $htzxjd,
            CONTRACT_FULFILLMENT_INFO_HTZXJD_FORMAT_INCORRECT
        );
    }

    const HTZJSFQEZF_MIN_LENGTH = 1;
    const HTZJSFQEZF_MAX_LENGTH = 100;
    public function htzjsfqezf($htzjsfqezf) : bool
    {
        return $this->lengthWidgetRule(
            self::HTZJSFQEZF_MIN_LENGTH,
            self::HTZJSFQEZF_MAX_LENGTH,
            $htzjsfqezf,
            CONTRACT_FULFILLMENT_INFO_HTZJSFQEZF_FORMAT_INCORRECT
        );
    }

    const SJLYDW_MIN_LENGTH = 1;
    const SJLYDW_MAX_LENGTH = 200;
    public function sjlydw($sjlydw) : bool
    {
        return $this->lengthWidgetRule(
            self::SJLYDW_MIN_LENGTH,
            self::SJLYDW_MAX_LENGTH,
            $sjlydw,
            CONTRACT_SJLYDW_FORMAT_INCORRECT
        );
    }

    const WYF_MIN_LENGTH = 1;
    const WYF_MAX_LENGTH = 200;
    public function wyf($wyf) : bool
    {
        return $this->lengthWidgetRule(
            self::WYF_MIN_LENGTH,
            self::WYF_MAX_LENGTH,
            $wyf,
            CONTRACT_BREACH_INFO_WYF_FORMAT_INCORRECT
        );
    }

    const WYSY_MIN_LENGTH = 1;
    const WYSY_MAX_LENGTH = 200;
    public function wysy($wysy) : bool
    {
        return $this->lengthWidgetRule(
            self::WYSY_MIN_LENGTH,
            self::WYSY_MAX_LENGTH,
            $wysy,
            CONTRACT_BREACH_INFO_WYSY_FORMAT_INCORRECT
        );
    }

    const WYYJ_MIN_LENGTH = 1;
    const WYYJ_MAX_LENGTH = 200;
    public function wyyj($wyyj) : bool
    {
        return $this->lengthWidgetRule(
            self::WYYJ_MIN_LENGTH,
            self::WYYJ_MAX_LENGTH,
            $wyyj,
            CONTRACT_BREACH_INFO_WYYJ_FORMAT_INCORRECT
        );
    }

    const WYZT_MIN_LENGTH = 1;
    const WYZT_MAX_LENGTH = 200;
    public function wyzt($wyzt) : bool
    {
        return $this->lengthWidgetRule(
            self::WYZT_MIN_LENGTH,
            self::WYZT_MAX_LENGTH,
            $wyzt,
            CONTRACT_BREACH_INFO_WYZT_FORMAT_INCORRECT
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

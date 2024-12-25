<?php
namespace Sdk\Common\Utils\Traits;

trait DesensitizationTrait
{
    /**
     * 数据脱敏
     * @param $string 需要脱敏值
     * @param int $start 开始
     * @param int $length 结束
     * @param string $reSymbol 脱敏替代符号
     * @return bool|string
     * 例子:
     * dataDesensitization('13126989876', 3, 4); //131****9876
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    protected function dataDesensitization(string $string, $start = 0, $end = 0, string $reSymbol = '*'): string
    {
        if (empty($string)) {
            return '';
        }

        $strLen = strlen($string);
        if ($strLen < ($start + $end)) {
            return $string;
        }

        $strEnd = $strLen-$end;
        for ($i=0; $i<$strLen; $i++) {
            if ($i>=$start && $i<$strEnd) {
                $strArr[] = $reSymbol;
            } else {
                $strArr[] = mb_substr($string, $i, 1);
            }
        }

        return implode('', $strArr);
    }

    protected function idCardDataDesensitization(string $idCard) : string
    {
        return $this->dataDesensitization($idCard, 4, 4);
    }

    protected function cellphoneDataDesensitization(string $cellphone) : string
    {
        return $this->dataDesensitization($cellphone, 3, 4);
    }
}

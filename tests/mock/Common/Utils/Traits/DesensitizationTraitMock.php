<?php
namespace Sdk\Common\Utils\Traits;

class DesensitizationTraitMock
{
    use DesensitizationTrait;

    public function dataDesensitizationPublic(
        string $string,
        $start = 0,
        $end = 0,
        string $reSymbol = '*'
    ) : string {
        return $this->dataDesensitization($string, $start, $end, $reSymbol);
    }

    public function idCardDataDesensitizationPublic(string $idCard) : string
    {
        return $this->idCardDataDesensitization($idCard);
    }

    public function cellphoneDataDesensitizationPublic(string $cellphone) : string
    {
        return $this->cellphoneDataDesensitization($cellphone);
    }
}

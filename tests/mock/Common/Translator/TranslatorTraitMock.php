<?php
namespace Sdk\Common\Translator;

use Marmot\Interfaces\INull;
use Sdk\Common\Model\NullMockObject;
use Sdk\Common\Model\Interfaces\IOperateAble;

class TranslatorTraitMock
{
    use TranslatorTrait;

    public function getNullObject() : INull
    {
        return NullMockObject::getInstance();
    }

    public function arrayToObjectPublic(array $expression, $object = null)
    {
        return $this->arrayToObject($expression, $object);
    }

    public function arrayToObjectsPublic(array $expression) : array
    {
        return $this->arrayToObjects($expression);
    }

    public function typeFormatConversionPublic(int $type, array $typeCnArray) : array
    {
        return $this->typeFormatConversion($type, $typeCnArray);
    }

    public function statusFormatConversionPublic(
        int $status,
        array $statusTypeArray = IOperateAble::STATUS_TYPE,
        array $statusCnArray = IOperateAble::STATUS_CN
    ) : array {
        return $this->statusFormatConversion($status, $statusTypeArray, $statusCnArray);
    }
}

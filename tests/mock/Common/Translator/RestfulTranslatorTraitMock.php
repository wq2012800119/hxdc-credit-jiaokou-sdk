<?php
namespace Sdk\Common\Translator;

class RestfulTranslatorTraitMock
{
    use RestfulTranslatorTrait;

    public function arrayToObject(array $expression, $object = null)
    {
        unset($expression);
        unset($object);
        return '';
    }

    public function arrayToObjectsPublic(array $expression) : array
    {
        return $this->arrayToObjects($expression);
    }

    public function singleArrayToObjectsPublic(array $expression) : array
    {
        return $this->singleArrayToObjects($expression);
    }

    public function listArrayToObjectsPublic(array $expression) : array
    {
        return $this->listArrayToObjects($expression);
    }

    public function includedFormatConversionPublic(array $included) : array
    {
        return $this->includedFormatConversion($included);
    }

    public function relationshipFillPublic(array $relationship, array $included) : array
    {
        return $this->relationshipFill($relationship, $included);
    }

    public function relationshipsFillPublic(array $relationship, array $included) : array
    {
        return $this->relationshipsFill($relationship, $included);
    }
}

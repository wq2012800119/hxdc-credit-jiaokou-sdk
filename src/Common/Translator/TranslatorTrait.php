<?php
namespace Sdk\Common\Translator;

use Marmot\Interfaces\INull;
use Sdk\Common\Model\Interfaces\IOperateAble;

trait TranslatorTrait
{
    abstract protected function getNullObject() : INull;

    public function arrayToObject(array $expression, $object = null)
    {
        unset($object);
        unset($expression);
        return $this->getNullObject();
    }

    public function arrayToObjects(array $expression) : array
    {
        unset($expression);
        return array();
    }

    protected function typeFormatConversion($type, array $typeCnArray) : array
    {
        return array(
            'id' => marmot_encode($type),
            'name' => isset($typeCnArray[$type]) ? $typeCnArray[$type] : ''
        );
    }

    protected function statusFormatConversion(
        int $status,
        array $statusTypeArray = IOperateAble::STATUS_TYPE,
        array $statusCnArray = IOperateAble::STATUS_CN
    ) : array {
        return array(
            'id' => marmot_encode($status),
            'type' => isset($statusTypeArray[$status]) ? $statusTypeArray[$status] : '',
            'name' => isset($statusCnArray[$status]) ? $statusCnArray[$status] : ''
        );
    }
}

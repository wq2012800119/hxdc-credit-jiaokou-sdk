<?php
namespace Sdk\Common\Translator;

use Marmot\Interfaces\IRestfulTranslator;

class MockRestfulTranslatorAdapter implements IRestfulTranslator
{
    public function arrayToObject(array $expression, $object = null)
    {
        unset($expression);
        unset($object);

        return [];
    }

    public function objectToArray($object, array $keys = array())
    {
        unset($object);
        unset($keys);

        return [];
    }

    public function arrayToObjects(array $expression) : array
    {
        unset($expression);

        return [];
    }
}

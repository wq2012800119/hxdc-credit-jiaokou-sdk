<?php
namespace Sdk\Common\Translator;

use Marmot\Interfaces\INull;

trait RestfulTranslatorTrait
{
    abstract public function arrayToObject(array $expression, $object = null);
    
    public function arrayToObjects(array $expression) : array
    {
        $isExistNextPage = 0;
        $objects = array();
        
        if (isset($expression['meta']['existNextPage'])) {
            $isExistNextPage = $expression['meta']['existNextPage'];
        }

        if (!empty($expression) && isset($expression['data'])) {
            //判断expression数据是多条还是单条,如果单条则走singleArrayToObjects方法,如果是多条则走listArrayToObjects方法
            $objects = isset($expression['data'][0]) ?
                                    $this->listArrayToObjects($expression) :
                                    $this->singleArrayToObjects($expression);
        }

        return array($isExistNextPage, $objects);
    }

    //单条数据数组转对象
    protected function singleArrayToObjects(array $expression) : array
    {
        $id = isset($expression['data']['id']) ? $expression['data']['id'] : 0;
        $object = $this->arrayToObject($expression);

        return array($id => $object);
    }

    //多条数据数组转对象
    protected function listArrayToObjects(array $expression) : array
    {
        $objects = array();
        $list = isset($expression['data']) ? $expression['data'] : array();
        $included = isset($expression['included']) ? $expression['included'] : array();

        foreach ($list as $objectArray) {
            $data = array(
                'data' => $objectArray,
                'included' => $included
            );

            $id = isset($objectArray['id']) ? $objectArray['id'] : 0;
            $object = $this->arrayToObject($data);
            $objects[$id] = $object;
        }

        return $objects;
    }

    public function includedFormatConversion(array $included) : array
    {
        $formatConversion = array();
        foreach ($included as $expression) {
            if (isset($expression['type']) && isset($expression['id'])) {
                $type = $expression['type'];
                $id = $expression['id'];

                $data = array(
                    'data' => $expression,
                    'included' => $included
                );

                $formatConversion[$type][$id] = $data;
            }
        }

        return $formatConversion;
    }

    //单数
    public function relationshipFill(array $relationship, array $included) : array
    {
        $type = isset($relationship['data']['type']) ? $relationship['data']['type'] : '';
        $id = isset($relationship['data']['id']) ? $relationship['data']['id'] : '';

        return isset($included[$type][$id]) ? $included[$type][$id] : array();
    }

    //复数
    public function relationshipsFill(array $relationship, array $included) : array
    {
        $list = array();

        $dataRelationships = isset($relationship['data']) ? $relationship['data'] : array();

        foreach ($dataRelationships as $dataRelationship) {
            $type = isset($dataRelationship['type']) ? $dataRelationship['type'] : '';
            $id = isset($dataRelationship['id']) ? $dataRelationship['id'] : '';
            $list[] = isset($included[$type][$id]) ? $included[$type][$id] : array();
        }

        return $list;
    }
}

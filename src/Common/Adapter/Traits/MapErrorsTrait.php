<?php
namespace Sdk\Common\Adapter\Traits;

use Marmot\Core;

trait MapErrorsTrait
{
    abstract protected function getAlonePossessMapErrors() : array;

    public function lastErrorPointer()
    {
        $contents = $this->getContents();

        return isset($contents['errors'][0]['meta']['field'])
        ? $contents['errors'][0]['meta']['field']
        : '';
    }
    
    protected function getMapErrors() : array
    {
        $mapError = $this->getAlonePossessMapErrors();

        $commonMapErrors = $this->commonMapErrors();

        return $mapError+$commonMapErrors;
    }

    public function commonMapErrors() : array
    {
        return [
            100005 => RESOURCE_NOT_EXIST,
        ];
    }

    protected function mapErrors() : void
    {
        $this->isSingleErrors() ? $this->singleMapErrors() : $this->multipleMapErrors();
    }

    protected function singleMapErrors()
    {
        $id = $this->lastErrorId();
        $pointer = $this->lastErrorPointer();
        $mapErrors = $this->getMapErrors();
   
        $mappingPointer = strstr($pointer, '.') ? substr($pointer, 0, strpos($pointer, '.')) : $pointer;
        $pointer = strstr($pointer, '.') ? ltrim(ltrim($pointer, $mappingPointer), '.') : $pointer;
        
        if (isset($mapErrors[$id])) {
            is_array($mapErrors[$id])
            ? Core::setLastError($mapErrors[$id][$mappingPointer], array('pointer'=>$pointer))
            : Core::setLastError($mapErrors[$id], array('pointer'=>$pointer));
        }
    }

    protected function multipleMapErrors()
    {
        $contents = $this->getContents();
        $errors = isset($contents['errors']) ? $contents['errors'] : array();

        $id = 0;
        $mappingPointer = '';
        $pointers = array();
        $mapErrors = $this->getMapErrors();

        foreach ($errors as $error) {
            if (isset($error['id']) && isset($error['meta']['field'])) {
                $id = $error['id'];
                $field = $error['meta']['field'];
                $mappingPointer = substr($field, 0, strpos($field, '.'));
                $pointers[] = ltrim(ltrim($field, $mappingPointer), '.');
            }
        }
        
        $pointer = implode(',', array_unique($pointers));

        if (isset($mapErrors[$id])) {
            is_array($mapErrors[$id])
            ? Core::setLastError($mapErrors[$id][$mappingPointer], array('pointer'=>$pointer))
            : Core::setLastError($mapErrors[$id], array('pointer'=>$pointer));
        }
    }

    protected function isSingleErrors()
    {
        $singleErrorCount = 1;
        $contents = $this->getContents();
        $errors = isset($contents['errors']) ? $contents['errors'] : array();

        return ($singleErrorCount >= count($errors));
    }
}

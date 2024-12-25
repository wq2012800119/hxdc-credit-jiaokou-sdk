<?php
namespace Sdk\Application\Commitment\Translator;

use Sdk\Application\Commitment\Model\PromiseSnapshot;
use Sdk\Application\Commitment\Model\NullPromiseSnapshot;

class PromiseSnapshotRestfulTranslator extends PromiseRestfulTranslator
{
    public function arrayToObject(array $expression, $snapshot = null)
    {
        if (empty($expression)) {
            return NullPromiseSnapshot::getInstance();
        }

        if ($snapshot == null) {
            $snapshot = new PromiseSnapshot();
        }
       
        $snapshot = parent::arrayToObject($expression, $snapshot);

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        
        if (isset($attributes['promiseId'])) {
            $snapshot->setPromiseId($attributes['promiseId']);
        }
        
        return $snapshot;
    }

    public function objectToArray($snapshot, array $keys = array())
    {
        unset($snapshot);
        unset($keys);
        return [];
    }
}

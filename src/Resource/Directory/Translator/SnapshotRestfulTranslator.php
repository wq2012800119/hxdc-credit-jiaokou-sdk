<?php
namespace Sdk\Resource\Directory\Translator;

use Sdk\Resource\Directory\Model\DirectorySnapshot;
use Sdk\Resource\Directory\Model\NullDirectorySnapshot;

class SnapshotRestfulTranslator extends DirectoryRestfulTranslator
{
    public function arrayToObject(array $expression, $snapshot = null)
    {
        if (empty($expression)) {
            return NullDirectorySnapshot::getInstance();
        }

        if ($snapshot == null) {
            $snapshot = new DirectorySnapshot();
        }
       
        $snapshot = parent::arrayToObject($expression, $snapshot);

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        
        if (isset($attributes['directoryId'])) {
            $snapshot->setDirectoryId($attributes['directoryId']);
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

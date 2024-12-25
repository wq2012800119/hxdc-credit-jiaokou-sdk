<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\INull;

use Sdk\Resource\Directory\Model\DirectorySnapshot;
use Sdk\Resource\Directory\Model\NullDirectorySnapshot;

class SnapshotTranslator extends DirectoryTranslator
{
    protected function getNullObject() : INull
    {
        return NullDirectorySnapshot::getInstance();
    }

    public function objectToArray($snapshot, array $keys = array())
    {
        if (!$snapshot instanceof DirectorySnapshot) {
            return array();
        }

        $expression = parent::objectToArray($snapshot, $keys);
        
        if (empty($keys)) {
            $keys = array(
                'directoryId'
            );
        }

        if (in_array('directoryId', $keys)) {
            $expression['directoryId'] = marmot_encode($snapshot->getDirectoryId());
        }

        return $expression;
    }
}

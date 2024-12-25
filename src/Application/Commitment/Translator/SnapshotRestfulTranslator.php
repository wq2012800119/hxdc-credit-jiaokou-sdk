<?php
namespace Sdk\Application\Commitment\Translator;

use Sdk\Application\Commitment\Model\CommitmentSnapshot;
use Sdk\Application\Commitment\Model\NullCommitmentSnapshot;

class SnapshotRestfulTranslator extends CommitmentRestfulTranslator
{
    public function arrayToObject(array $expression, $snapshot = null)
    {
        if (empty($expression)) {
            return NullCommitmentSnapshot::getInstance();
        }

        if ($snapshot == null) {
            $snapshot = new CommitmentSnapshot();
        }
       
        $snapshot = parent::arrayToObject($expression, $snapshot);

        $attributes = isset($expression['data']['attributes']) ? $expression['data']['attributes'] : array();
        
        if (isset($attributes['commitmentId'])) {
            $snapshot->setCommitmentId($attributes['commitmentId']);
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

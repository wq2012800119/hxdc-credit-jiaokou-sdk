<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\INull;

use Sdk\Application\Commitment\Model\CommitmentSnapshot;
use Sdk\Application\Commitment\Model\NullCommitmentSnapshot;

class SnapshotTranslator extends CommitmentTranslator
{
    protected function getNullObject() : INull
    {
        return NullCommitmentSnapshot::getInstance();
    }

    public function objectToArray($snapshot, array $keys = array())
    {
        if (!$snapshot instanceof CommitmentSnapshot) {
            return array();
        }

        $expression = parent::objectToArray($snapshot, $keys);
        
        if (empty($keys)) {
            $keys = array(
                'commitmentId'
            );
        }

        if (in_array('commitmentId', $keys)) {
            $expression['commitmentId'] = marmot_encode($snapshot->getCommitmentId());
        }

        return $expression;
    }
}

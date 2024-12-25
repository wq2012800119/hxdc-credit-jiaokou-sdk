<?php
namespace Sdk\Application\Commitment\Translator;

use Marmot\Interfaces\INull;

use Sdk\Application\Commitment\Model\PromiseSnapshot;
use Sdk\Application\Commitment\Model\NullPromiseSnapshot;

class PromiseSnapshotTranslator extends PromiseTranslator
{
    protected function getNullObject() : INull
    {
        return NullPromiseSnapshot::getInstance();
    }

    public function objectToArray($snapshot, array $keys = array())
    {
        if (!$snapshot instanceof PromiseSnapshot) {
            return array();
        }

        $expression = parent::objectToArray($snapshot, $keys);
        
        if (empty($keys)) {
            $keys = array(
                'promiseId'
            );
        }

        if (in_array('promiseId', $keys)) {
            $expression['promiseId'] = marmot_encode($snapshot->getPromiseId());
        }

        return $expression;
    }
}

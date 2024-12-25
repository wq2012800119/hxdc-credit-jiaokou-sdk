<?php
namespace Sdk\Resource\Directory\Adapter\Snapshot;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

class SnapshotRestfulAdapterMock extends SnapshotRestfulAdapter
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getScenario() : array
    {
        return parent::getScenario();
    }
}

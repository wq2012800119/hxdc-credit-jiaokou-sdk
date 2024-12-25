<?php
namespace Sdk\Resource\UploadDataTask\Adapter\Record;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

class RecordRestfulAdapterMock extends RecordRestfulAdapter
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

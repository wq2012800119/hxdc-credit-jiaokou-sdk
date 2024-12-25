<?php
namespace Sdk\Log\ApplicationLog\Adapter\ApplicationLog;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

class ApplicationLogRestfulAdapterMock extends ApplicationLogRestfulAdapter
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

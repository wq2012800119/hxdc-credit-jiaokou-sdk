<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

class EnterpriseRestfulAdapterMock extends EnterpriseRestfulAdapter
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getScenario() : array
    {
        return parent::getScenario();
    }

    public function getAlonePossessMapErrorsPublic() : array
    {
        return parent::getAlonePossessMapErrors();
    }
}

<?php
namespace Sdk\Common\Adapter;

use Marmot\Interfaces\INull;
use Marmot\Interfaces\IRestfulTranslator;

trait CommonRestfulAdapterTrait
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getAlonePossessMapErrorsPublic() : array
    {
        return parent::getAlonePossessMapErrors();
    }

    public function getScenario() : array
    {
        return parent::getScenario();
    }

    public function insertTranslatorKeysPublic() : array
    {
        return parent::insertTranslatorKeys();
    }

    public function updateTranslatorKeysPublic() : array
    {
        return parent::updateTranslatorKeys();
    }
}

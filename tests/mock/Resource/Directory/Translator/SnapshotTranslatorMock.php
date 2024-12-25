<?php
namespace Sdk\Resource\Directory\Translator;

use Marmot\Interfaces\INull;

class SnapshotTranslatorMock extends SnapshotTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }
}

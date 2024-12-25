<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use Marmot\Interfaces\INull;

class RecordTranslatorMock extends RecordTranslator
{
    public function getNullObjectPublic() : INull
    {
        return parent::getNullObject();
    }

    public function getUploadDataTaskTranslatorPublic() : UploadDataTaskTranslator
    {
        return parent::getUploadDataTaskTranslator();
    }
}

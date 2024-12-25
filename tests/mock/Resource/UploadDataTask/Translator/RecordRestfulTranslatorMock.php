<?php
namespace Sdk\Resource\UploadDataTask\Translator;

class RecordRestfulTranslatorMock extends RecordRestfulTranslator
{
    public function getUploadDataTaskRestfulTranslatorPublic() : UploadDataTaskRestfulTranslator
    {
        return parent::getUploadDataTaskRestfulTranslator();
    }
}

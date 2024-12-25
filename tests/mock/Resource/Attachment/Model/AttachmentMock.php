<?php
namespace Sdk\Resource\Attachment\Model;

class AttachmentMock extends Attachment
{
    public function validatePublic() : bool
    {
        return parent::validate();
    }

    public function validateFileSizePublic() : bool
    {
        return parent::validateFileSize();
    }

    public function validateFileExtensionPublic() : bool
    {
        return parent::validateFileExtension();
    }

    public function validateFileNamePublic() : bool
    {
        return parent::validateFileName();
    }

    public function getFileNamePublic() : string
    {
        return parent::getFileName();
    }

    public function getFilePathPublic(string $fileName, string $date) : string
    {
        return parent::getFilePath($fileName, $date);
    }
}

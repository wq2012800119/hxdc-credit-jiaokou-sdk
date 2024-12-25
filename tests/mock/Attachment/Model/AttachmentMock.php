<?php
namespace Sdk\Attachment\Model;

class AttachmentMock extends Attachment
{
    public function validatePublic() : bool
    {
        return parent::validate();
    }

    public function validateFileIsExistPublic() : bool
    {
        return parent::validateFileIsExist();
    }

    public function validateFileExtensionPublic() : bool
    {
        return parent::validateFileExtension();
    }

    public function validateFileSizePublic() : bool
    {
        return parent::validateFileSize();
    }

    public function validateFileErrorPublic() : bool
    {
        return parent::validateFileError();
    }

    public function getAttachmentExtensionPublic() : string
    {
        return parent::getAttachmentExtension();
    }

    public function getFileNamePublic() : string
    {
        return parent::getFileName();
    }

    public function getFilePathPublic(string $fileName, string $date) : string
    {
        return parent::getFilePath($fileName, $date);
    }

    public function movePublic(string $filePath) : bool
    {
        return parent::move($filePath);
    }

    public function builtInMovePublic(string $tmpName, string $filePath) : bool
    {
        return parent::builtInMove($tmpName, $filePath);
    }
}

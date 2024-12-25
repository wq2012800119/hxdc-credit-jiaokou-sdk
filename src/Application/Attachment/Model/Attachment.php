<?php
namespace Sdk\Application\Attachment\Model;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Attachment\Model\Attachment as CommonAttachment;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

class Attachment extends CommonAttachment
{

    const MAX_FILE_SIZE = 10 * 1024 * 1024; //10MB
    const ALLOW_ATTACHMENT_EXTENSION = array('xls', 'xlsx');
    
    /**
     * @var Staff $staff 员工
     */
    private $staff;

    public function __construct(array $file = array())
    {
        parent::__construct($file);
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
    }

    public function __destruct()
    {
        unset($this->staff);
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    protected function validate() : bool
    {
        return $this->validateFileIsExist()
            && $this->validateFileExtension()
            && $this->validateFileSize()
            && $this->validateFileError();
    }

    protected function validateFileSize() : bool
    {
        $size = $this->getSize();

        if ($size > self::MAX_FILE_SIZE) {
            Core::setLastError(FILE_SIZE_LIMIT_EXCEEDED); //文件大小超出限制
            return false;
        }

        return true;
    }
    
    protected function validateFileExtension() : bool
    {
        $attachmentExtension = $this->getAttachmentExtension();

        if (!in_array($attachmentExtension, self::ALLOW_ATTACHMENT_EXTENSION)) {
            Core::setLastError(FILE_EXTENSION_NOT_SUPPORTED); //文件后缀不支持
            return false;
        }

        return true;
    }

    protected function getFileName() : string
    {
        $attachmentExtension = $this->getAttachmentExtension();
        $staffId = $this->getStaff()->getId();
        $time = Core::$container->get('time');
        $name = $this->getName();
        $name = substr($name, 0, strrpos($name, "."));
        $randomChar = $this->randomChar(self::FILE_NAME_RANDOM_CHAR_LENGTH);
        
        return $name.'_'.$staffId.'_'.md5($randomChar.$time.$name.$staffId).'.'.$attachmentExtension;
    }
    
    protected function getFilePath(string $fileName, string $date) : string
    {
        $filePath = Core::$container->get('attachment.resource.upload.path').$date;

        if (!file_exists($filePath)) {
            mkdir($filePath, 0705, true);
        }
        return $filePath.$fileName;
    }
}

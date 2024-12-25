<?php
namespace Sdk\Resource\Attachment\Model;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Attachment\Model\Attachment as CommonAttachment;

use Sdk\User\Staff\Model\Staff;
use Sdk\User\Staff\Model\OrganizationUserStaff;

use Sdk\Resource\Directory\Model\Directory;

class Attachment extends CommonAttachment
{

    const MAX_FILE_SIZE = 10 * 1024 * 1024; //10MB
    const ALLOW_ATTACHMENT_EXTENSION = array('xls', 'xlsx');
    
    /**
     * @var Staff $staff 员工
     */
    private $staff;

    /**
     * @var Directory $directory 目录
     */
    private $directory;

    public function __construct(array $file = array())
    {
        parent::__construct($file);
        $this->staff = Core::$container->has('staff') ? Core::$container->get('staff') : new OrganizationUserStaff();
        $this->directory = new Directory();
    }

    public function __destruct()
    {
        unset($this->staff);
        unset($this->directory);
    }

    public function setDirectory(Directory $directory): void
    {
        $this->directory = $directory;
    }

    public function getDirectory(): Directory
    {
        return $this->directory;
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
            && $this->validateFileError()
            && $this->validateFileName();
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

    //验证文件名是否符合格式: 目录名称_目录标识_目录最新快照id.xls, 并验证是否与目录中的名称,标识,id一致
    protected function validateFileName() : bool
    {
        return true;
        $name = $this->getName();
        $name = substr($name, 0, strrpos($name, "."));
        $directory = $this->getDirectory();

        //检测'_'第一次出现的位置
        $startLength = strpos($name, '_');
        //检测'_最后一次出现的位置
        $endLength = strrpos($name, '_');
        $directoryName = substr($name, 0, $startLength);
        $directoryVersion = substr($name, $endLength+1);//截取时需要加上'_'的字符数
        $directoryIdentify = substr($name, $startLength+1, $endLength-$startLength-1);//截取时需要减去'_'的字符数

        if ($directoryName == $directory->getName() && $directoryIdentify == $directory->getIdentify()
            && $directoryVersion == $directory->getVersion()
        ) {
            return true;
        }

        Core::setLastError(FILE_UPLOAD_INCORRECT); //文件名不正确
        return false;
    }

    protected function getFileName() : string
    {
        $attachmentExtension = $this->getAttachmentExtension();
        $staffId = $this->getStaff()->getId();
        $name = $this->getName();
        $name = substr($name, 0, strrpos($name, "."));
        $time = Core::$container->get('time');
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

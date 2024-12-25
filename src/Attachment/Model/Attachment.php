<?php
namespace Sdk\Attachment\Model;

use Marmot\Core;
use Respect\Validation\Validator as V;

use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class Attachment
{
    use CharacterGeneratorTrait;
    
    const FILE_NAME_RANDOM_CHAR_LENGTH = 6;
    const MAX_FILE_SIZE = 2 * 1024 * 1024; //2MB
    const DEFAULT_ERROR_CODE = 0; //默认错误码
    const ALLOW_ATTACHMENT_EXTENSION = array(
        'doc', 'docx', 'xls', 'xlsx', 'pdf', 'zip', 'rar', 'lzh', 'jar', 'ppt', 'png', 'jpg', 'jpeg', 'gif', 'txt'
    );
    
    /**
     * @var string $name 上传文件名
     */
    private $name;
    /**
     * @var string $type 文件类型
     */
    private $type;
    /**
     * @var string $tmpName 文件临时存储的位置
     */
    private $tmpName;
    /**
     * @var int $size 文件大小
     */
    private $size;
    /**
     * @var int $error 由文件上传导致的错误代码
     */
    private $error;

    public function __construct(array $file = array())
    {
        $this->name = isset($file['name']) ? $file['name'] : '';
        $this->type = isset($file['type']) ? $file['type'] : '';
        $this->tmpName = isset($file['tmp_name']) ? $file['tmp_name'] : '';
        $this->size = isset($file['size']) ? $file['size'] : 0;
        $this->error = isset($file['error']) ? $file['error'] : 0;
    }

    public function __destruct()
    {
        unset($this->name);
        unset($this->type);
        unset($this->tmpName);
        unset($this->size);
        unset($this->error);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setTmpName(string $tmpName): void
    {
        $this->tmpName = $tmpName;
    }

    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setError(int $error): void
    {
        $this->error = $error;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = $this->getFileName();
            $date = date('Ym').'/';
            $filePath = $this->getFilePath($fileName, $date);
            if ($this->move($filePath)) {
                return $date.$fileName;
            }
        }

        return false;
    }

    protected function validate() : bool
    {
        return $this->validateFileIsExist()
            && $this->validateFileExtension()
            && $this->validateFileSize()
            && $this->validateFileError();
    }

    protected function validateFileIsExist() : bool
    {
        if (empty($this->getName())) {
            Core::setLastError(FILE_NOT_EXIST);
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

    protected function validateFileSize() : bool
    {
        $size = $this->getSize();

        if ($size > self::MAX_FILE_SIZE) {
            Core::setLastError(FILE_SIZE_LIMIT_EXCEEDED); //文件大小超出限制
            return false;
        }

        return true;
    }

    protected function validateFileError() : bool
    {
        $error = $this->getError();

        if ($error > self::DEFAULT_ERROR_CODE) {
            Core::setLastError(FILE_UPLOAD_INCORRECT); //由文件上传导致的错误代码
            return false;
        }

        return true;
    }

    protected function getAttachmentExtension() : string
    {
        $name = $this->getName();
        $file = explode('.', $name);
        return end($file);
    }
    
    protected function getFileName() : string
    {
        $attachmentExtension = $this->getAttachmentExtension();
        $name = $this->getName();
        $time = Core::$container->get('time');
        $randomChar = $this->randomChar(self::FILE_NAME_RANDOM_CHAR_LENGTH);
        
        return md5($randomChar.$time.$name).'.'.$attachmentExtension;
    }
    
    protected function getFilePath(string $fileName, string $date) : string
    {
        $filePath = Core::$container->get('attachment.upload.path').$date;
        if (!file_exists($filePath)) {
            mkdir($filePath, 0705);
        }
        return $filePath.$fileName;
    }

    protected function move(string $filePath) : bool
    {
        $tmpName = $this->getTmpName();
        if (!$this->builtInMove($tmpName, $filePath)) {
            Core::setLastError(FILE_UPLOAD_PATH_NOT_EXIST);
            return false;
        }

        return true;
    }

    protected function builtInMove(string $tmpName, string $filePath) : bool
    {
        return move_uploaded_file($tmpName, $filePath);
    }
}

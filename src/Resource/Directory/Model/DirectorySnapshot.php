<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Core;

class DirectorySnapshot extends Directory
{
    /**
     * @var int $directoryId 目录id
     */
    private $directoryId;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        
        $this->directoryId = 0;
    }

    public function __destruct()
    {
        unset($this->directoryId);
    }

    public function setDirectoryId(int $directoryId): void
    {
        $this->directoryId = $directoryId;
    }

    public function getDirectoryId(): int
    {
        return $this->directoryId;
    }

    public function insert() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function update() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function enable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function disable() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function approve() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function reject() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }
}

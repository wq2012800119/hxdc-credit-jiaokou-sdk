<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Core;

class PromiseSnapshot extends Promise
{
    /**
     * @var int $promiseId 履约践诺id
     */
    private $promiseId;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        
        $this->promiseId = 0;
    }

    public function __destruct()
    {
        unset($this->promiseId);
    }

    public function setPromiseId(int $promiseId): void
    {
        $this->promiseId = $promiseId;
    }

    public function getPromiseId(): int
    {
        return $this->promiseId;
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

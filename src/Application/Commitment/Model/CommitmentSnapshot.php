<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Core;

class CommitmentSnapshot extends Commitment
{
    /**
     * @var int $commitmentId 信用承诺id
     */
    private $commitmentId;

    public function __construct(int $id = 0)
    {
        parent::__construct($id);
        
        $this->commitmentId = 0;
    }

    public function __destruct()
    {
        unset($this->commitmentId);
    }

    public function setCommitmentId(int $commitmentId): void
    {
        $this->commitmentId = $commitmentId;
    }

    public function getCommitmentId(): int
    {
        return $this->commitmentId;
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

    public function superviseDoing() : bool
    {
        Core::setLastError(METHOD_NOT_ALLOWED);
        return false;
    }

    public function superviseDone() : bool
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

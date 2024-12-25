<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Interfaces\INull;

class NullCommitmentSnapshot extends CommitmentSnapshot implements INull
{
    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

<?php
namespace Sdk\Log\ApplicationLog\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class ApplicationLogPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['APPLICATION_LOG']);
    }

    public function export() : bool
    {
        return $this->operation('export');
    }
}

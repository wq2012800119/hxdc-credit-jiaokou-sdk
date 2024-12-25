<?php
namespace Sdk\Statistics\Record\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class CreditModulePurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['CREDIT_MODULE_STATISTICS']);
    }
}

<?php
namespace Sdk\CreditReport\CommonConfig\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class CommonConfigPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['CREDIT_REPORT_COMMON_CONFIG']);
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
}

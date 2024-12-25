<?php
namespace Sdk\Statistics\Record\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class WorkbenchPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['WORKBENCH']);
    }
}

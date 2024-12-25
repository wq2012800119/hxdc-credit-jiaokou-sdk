<?php
namespace Sdk\Rap\RapCase\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class RapCasePurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['RAP_CASE']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }
    
    public function export() : bool
    {
        return $this->operation('export');
    }
}

<?php
namespace Sdk\Role\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class RolePurview extends Purview
{

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['ROLE']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
}

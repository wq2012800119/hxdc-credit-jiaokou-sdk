<?php
namespace Sdk\Organization\Organization\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class OrganizationPurview extends Purview
{

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['ORGANIZATION']);
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

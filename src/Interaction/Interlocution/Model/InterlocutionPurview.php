<?php
namespace Sdk\Interaction\Interlocution\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class InterlocutionPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['INTERACTION_INTERLOCUTION']);
    }

    public function accept() : bool
    {
        return $this->operation('accept');
    }

    public function forward() : bool
    {
        return $this->operation('forward');
    }
}

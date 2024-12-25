<?php
namespace Sdk\Interaction\Praise\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class PraisePurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['INTERACTION_PRAISE']);
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

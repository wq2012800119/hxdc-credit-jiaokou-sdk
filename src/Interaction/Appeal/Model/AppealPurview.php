<?php
namespace Sdk\Interaction\Appeal\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class AppealPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['INTERACTION_APPEAL']);
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

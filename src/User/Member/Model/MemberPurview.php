<?php
namespace Sdk\User\Member\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class MemberPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['MEMBER']);
    }

    public function enable() : bool
    {
        return $this->operation('enable');
    }

    public function disable() : bool
    {
        return $this->operation('disable');
    }
}

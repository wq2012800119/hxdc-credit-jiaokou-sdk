<?php
namespace Sdk\Sensitive\Word\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class SensitiveWordPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['SENSITIVE_WORD']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
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

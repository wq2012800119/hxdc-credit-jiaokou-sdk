<?php
namespace Sdk\Dictionary\Item\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class DictionaryPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['DICTIONARY']);
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

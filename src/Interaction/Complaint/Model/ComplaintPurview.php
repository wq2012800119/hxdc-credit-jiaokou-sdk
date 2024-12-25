<?php
namespace Sdk\Interaction\Complaint\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class ComplaintPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['INTERACTION_COMPLAINT']);
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

<?php
namespace Sdk\Interaction\Feedback\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class FeedbackPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['INTERACTION_FEEDBACK']);
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

<?php
namespace Sdk\Statistics\Record\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class CommitmentPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['COMMITMENT_STATISTICS']);
    }
}

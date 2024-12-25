<?php
namespace Sdk\Member\Commitment\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class CommitmentPurview extends Purview
{
    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['MEMBER_COMMITMENT']);
    }

    public function fetch() : bool
    {
        $staffPurview = $this->fetchStaffPurview();
        $commitmentColumn = IPurviewAble::COLUMN['MEMBER_COMMITMENT'];
        $commitmentExamineColumn = IPurviewAble::COLUMN['MEMBER_COMMITMENT_EXAMINE'];

        return (isset($staffPurview[$commitmentColumn]) || isset($staffPurview[$commitmentExamineColumn]));
    }

    public function approve() : bool
    {
        return $this->operation('approve', IPurviewAble::COLUMN['MEMBER_COMMITMENT_EXAMINE']);
    }

    public function reject() : bool
    {
        return $this->operation('reject', IPurviewAble::COLUMN['MEMBER_COMMITMENT_EXAMINE']);
    }
}

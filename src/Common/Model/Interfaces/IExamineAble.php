<?php
namespace Sdk\Common\Model\Interfaces;

interface IExamineAble
{
    const EXAMINE_STATUS = array(
        'PENDING' => 0,
        'APPROVE' => 2,
        'REJECT' => -2
    );

    const EXAMINE_STATUS_CN = array(
        self::EXAMINE_STATUS['PENDING'] => '待审核',
        self::EXAMINE_STATUS['APPROVE'] => '已通过',
        self::EXAMINE_STATUS['REJECT'] => '已驳回'
    );

    const EXAMINE_STATUS_TYPE = array(
        self::EXAMINE_STATUS['PENDING'] => 'warning',
        self::EXAMINE_STATUS['APPROVE'] => 'success',
        self::EXAMINE_STATUS['REJECT'] => 'danger'
    );

    public function approve() : bool;
    
    public function reject() : bool;
}

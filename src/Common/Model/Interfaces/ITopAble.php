<?php
namespace Sdk\Common\Model\Interfaces;

interface ITopAble
{
    const TOP_STATUS = array(
        'NO_TOP' => 0,
        'TOP' => 1
    );

    const TOP_STATUS_CN = array(
        self::TOP_STATUS['NO_TOP'] => '未置顶',
        self::TOP_STATUS['TOP'] => '已置顶'
    );

    const TOP_STATUS_TYPE = array(
        self::TOP_STATUS['NO_TOP'] => 'danger',
        self::TOP_STATUS['TOP'] => 'success'
    );

    public function top() : bool;
    
    public function cancelTop() : bool;
}

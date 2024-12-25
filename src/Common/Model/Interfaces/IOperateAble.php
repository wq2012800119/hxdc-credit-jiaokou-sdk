<?php
namespace Sdk\Common\Model\Interfaces;

interface IOperateAble
{
    const STATUS = array(
        'ENABLED' => 0 ,
        'DISABLED' => -2
    );

    const STATUS_CN = array(
        self::STATUS['ENABLED'] => '启用',
        self::STATUS['DISABLED'] => '禁用'
    );

    const STATUS_TYPE = array(
        self::STATUS['ENABLED'] => 'success',
        self::STATUS['DISABLED'] => 'danger'
    );

    public function insert() : bool;
    
    public function update() : bool;

    public function enable() : bool;
    
    public function disable() : bool;
}

<?php
namespace Sdk\Article\Article\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

use Sdk\Common\Model\Traits\NullTopAbleTrait;
use Sdk\Common\Model\Traits\NullExamineAbleTrait;
use Sdk\Common\Model\Traits\NullOperateAbleTrait;

class NullArticle extends Article implements INull
{
    use NullOperateAbleTrait, NullExamineAbleTrait, NullTopAbleTrait;

    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function resourceNotExist() : bool
    {
        Core::setLastError(RESOURCE_NOT_EXIST);
        return false;
    }
}

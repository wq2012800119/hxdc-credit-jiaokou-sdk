<?php
namespace Sdk\Common\Utils;

use Marmot\Framework\Classes\Session;

class CommonSession extends Session
{
    const KEY = 'utils';

    public function __construct()
    {
        parent::__construct(self::KEY);
    }
}

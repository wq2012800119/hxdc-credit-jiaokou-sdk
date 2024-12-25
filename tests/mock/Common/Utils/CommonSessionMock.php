<?php
namespace Sdk\Common\Utils;

class CommonSessionMock extends CommonSession
{
    public function getKey() : string
    {
        return parent::getKey();
    }
}

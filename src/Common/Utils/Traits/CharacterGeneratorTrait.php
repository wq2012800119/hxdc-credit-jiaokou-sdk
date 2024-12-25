<?php
namespace Sdk\Common\Utils\Traits;

trait CharacterGeneratorTrait
{
    protected function randomChar($length = 6, $chars = null) : string
    {
        if (empty($chars)) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }

        $charsLen = strlen($chars) - 1;
        $randstr='';

        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $charsLen);
            $randstr .= $chars[$num];
        }

        return $randstr;
    }
}

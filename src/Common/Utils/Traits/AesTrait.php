<?php
namespace Sdk\Common\Utils\Traits;

use Sdk\Common\Utils\Aes;

trait AesTrait
{
    protected function getAes() : Aes
    {
        return new Aes();
    }

    public function generateAesSecretKey() : array
    {
        return $this->getAes()->generateSecretKey();
    }

    //AES加密
    public function encrypt(string $data) : string
    {
        return $this->getAes()->encrypt($data);
    }

    //AES解密
    public function decrypt(string $encode) : string
    {
        return $this->getAes()->decrypt($encode);
    }
}

<?php
namespace Sdk\Common\Utils\Traits;

use Sdk\Common\Utils\Aes;

class AesTraitMock
{
    use AesTrait;

    public function getAesPublic() : Aes
    {
        return $this->getAes();
    }

    public function generateAesSecretKeyPublic() : array
    {
        return $this->generateAesSecretKey();
    }

    public function encryptPublic(string $data) : string
    {
        return $this->encrypt($data);
    }

    public function decryptPublic(string $encode) : string
    {
        return $this->decrypt($encode);
    }
}

<?php
namespace Sdk\Common\Utils;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Common\Utils\Traits\CharacterGeneratorTrait;

class AesTest extends TestCase
{
    use CharacterGeneratorTrait;

    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(AesMock::class)
                           ->setMethods([
                               'randomChar',
                               'generateCacheSecretKey',
                               'get'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetCacheLayer()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Utils\Cache\AesCache',
            $this->stub->getCacheLayer()
        );
    }

    public function testGenerateSecretKey()
    {
        $key = $ivValue = 'eM1Ufu2Xict4prgA';
        $secretKey = array('key' => $key,'iv' => $ivValue);

        $this->stub->expects($this->exactly(2))->method('randomChar')->with(Aes::AES_KEY_LENGTH)->willReturn($key);

        $this->stub->expects($this->exactly(1))->method('generateCacheSecretKey')->with($secretKey)->willReturn(true);

        $result = $this->stub->generateSecretKey();

        $this->assertEquals($result, $secretKey);
    }

    public function testGenerateCacheSecretKey()
    {
        $this->stub = $this->getMockBuilder(AesMock::class)
                           ->setMethods(['save'])
                           ->getMock();

        $secretKey = array('secretKey');
        $cacheKey = Aes::AES_CACHE_ID;
        $expirationTime = Aes::EXPIRATION_TIME;

        $this->stub->expects($this->exactly(1))->method(
            'save'
        )->with($cacheKey, $secretKey, $expirationTime)->willReturn(true);

        $result = $this->stub->generateCacheSecretKeyPublic($secretKey);

        $this->assertTrue($result);
    }

    public function testEncryptFalse()
    {
        $aesSecretKeyCache = array('secretKey');
        $cacheKey = Aes::AES_CACHE_ID;
        $data = 'data';

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($aesSecretKeyCache);

        $result = $this->stub->encrypt($data);

        $this->assertEmpty($result);
    }

    public function testEncryptTrue()
    {
        $key = $this->randomChar(Aes::AES_KEY_LENGTH);
        $ivValue = $this->randomChar(Aes::AES_IV_LENGTH);
        $aesSecretKeyCache = array('key' => $key, 'iv' => $ivValue);
        $cacheKey = Aes::AES_CACHE_ID;
        $data = 'data';

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($aesSecretKeyCache);
        $result = $this->stub->encrypt($data);

        $this->assertIsString($result);
    }

    public function testDecryptFalse()
    {
        $aesSecretKeyCache = array('secretKey');
        $cacheKey = Aes::AES_CACHE_ID;
        $encode = 'encode';

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($aesSecretKeyCache);

        $result = $this->stub->decrypt($encode);

        $this->assertEmpty($result);
    }

    public function testDecryptTrue()
    {
        $key = $this->randomChar(Aes::AES_KEY_LENGTH);
        $ivValue = $this->randomChar(Aes::AES_IV_LENGTH);
        $aesSecretKeyCache = array('key' => $key, 'iv' => $ivValue);
        $cacheKey = Aes::AES_CACHE_ID;
        $encode = 'encode';

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($aesSecretKeyCache);
        $result = $this->stub->decrypt($encode);

        $this->assertIsString($result);
    }
}

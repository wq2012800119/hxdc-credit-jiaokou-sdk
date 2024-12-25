<?php
namespace Sdk\Common\Utils\Traits;

use PHPUnit\Framework\TestCase;

use Marmot\Framework\Classes\Request;

use Sdk\Common\Utils\Aes;

class AesTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(AesTraitMock::class)
                           ->setMethods(['getAes'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testGetAes()
    {
        $stub = new AesTraitMock();
        $this->assertInstanceOf(
            'Sdk\Common\Utils\Aes',
            $stub->getAesPublic()
        );
    }

    public function testGenerateAesSecretKey()
    {
        $data = array('data');

        $aes = $this->prophesize(Aes::class);
        $aes->generateSecretKey()->shouldBeCalled(1)->willReturn($data);
        $this->stub->expects($this->exactly(1))->method('getAes')->willReturn($aes->reveal());

        $result = $this->stub->generateAesSecretKeyPublic();

        $this->assertEquals($result, $data);
    }

    public function testEncrypt()
    {
        $data = 'data';
        $encode = 'encrypt';
        
        $aes = $this->prophesize(Aes::class);
        $aes->encrypt($data)->shouldBeCalled(1)->willReturn($encode);
        $this->stub->expects($this->exactly(1))->method('getAes')->willReturn($aes->reveal());

        $result = $this->stub->encryptPublic($data);

        $this->assertEquals($result, $encode);
    }

    public function testDecrypt()
    {
        $encode = 'encrypt';
        $decode = 'decrypt';
        
        $aes = $this->prophesize(Aes::class);
        $aes->decrypt($encode)->shouldBeCalled(1)->willReturn($decode);
        $this->stub->expects($this->exactly(1))->method('getAes')->willReturn($aes->reveal());

        $result = $this->stub->decryptPublic($encode);

        $this->assertEquals($result, $decode);
    }
}

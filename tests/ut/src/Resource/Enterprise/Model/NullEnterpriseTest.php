<?php
namespace Sdk\Resource\Enterprise\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullEnterpriseTest extends TestCase
{
    private $enterpriseStub;

    protected function setUp(): void
    {
        $this->enterpriseStub = $this->getMockBuilder(NullEnterprise::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->enterpriseStub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->enterpriseStub
        );
    }

    public function testExtendsEnterprise()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Model\Enterprise',
            $this->enterpriseStub
        );
    }

    public function testResourceNotExist()
    {
        $enterpriseStub = new NullEnterpriseMock();

        $result = $enterpriseStub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function initOperation($method)
    {
         $this->enterpriseStub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

         $result = $this->enterpriseStub->$method();
 
         $this->assertFalse($result);
    }

    public function testAuthorize()
    {
        $this->initOperation('authorize');
    }

    public function testUnAuthorize()
    {
        $this->initOperation('unAuthorize');
    }
}

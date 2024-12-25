<?php
namespace Sdk\Resource\NaturalPerson\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullNaturalPersonTest extends TestCase
{
    private $naturalPersonStub;

    protected function setUp(): void
    {
        $this->naturalPersonStub = $this->getMockBuilder(NullNaturalPerson::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->naturalPersonStub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->naturalPersonStub
        );
    }

    public function testExtendsNaturalPerson()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Model\NaturalPerson',
            $this->naturalPersonStub
        );
    }

    public function testResourceNotExist()
    {
        $naturalPersonStub = new NullNaturalPersonMock();

        $result = $naturalPersonStub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }

    public function initOperation($method)
    {
         $this->naturalPersonStub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

         $result = $this->naturalPersonStub->$method();
 
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

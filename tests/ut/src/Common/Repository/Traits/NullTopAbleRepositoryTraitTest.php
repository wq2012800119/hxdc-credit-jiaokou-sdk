<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class NullTopAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullTopAbleRepositoryTraitMock::class)
                           ->setMethods(['repositoryNotExist'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testTop()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->topPublic($this->object);

        $this->assertFalse($result);
    }

    public function testCancelTop()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->cancelTopPublic($this->object);

        $this->assertFalse($result);
    }
}

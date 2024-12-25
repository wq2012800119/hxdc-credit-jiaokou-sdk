<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class NullExamineAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullExamineAbleRepositoryTraitMock::class)
                           ->setMethods(['repositoryNotExist'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testApprove()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->approvePublic($this->object);

        $this->assertFalse($result);
    }

    public function testReject()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->rejectPublic($this->object);

        $this->assertFalse($result);
    }
}

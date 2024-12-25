<?php
namespace Sdk\Common\Repository\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class NullOperateAbleRepositoryTraitTest extends TestCase
{
    private $stub;
    private $object;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullOperateAbleRepositoryTraitMock::class)
                           ->setMethods(['repositoryNotExist'])
                           ->getMock();
        $this->object = new MockObject(1);
    }

    protected function tearDown(): void
    {
        unset($this->stub);
        unset($this->object);
    }

    public function testInsert()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->insertPublic($this->object);

        $this->assertFalse($result);
    }

    public function testUpdate()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->updatePublic($this->object);

        $this->assertFalse($result);
    }

    public function testEnable()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->enablePublic($this->object);

        $this->assertFalse($result);
    }

    public function testDisable()
    {
        $this->stub->expects($this->exactly(1))->method('repositoryNotExist')->willReturn(false);
        
        $result = $this->stub->disablePublic($this->object);

        $this->assertFalse($result);
    }
}

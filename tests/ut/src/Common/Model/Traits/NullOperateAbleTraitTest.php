<?php
namespace Sdk\Common\Model\Traits;

use PHPUnit\Framework\TestCase;

class NullOperateAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullOperateAbleTraitMock::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testInsert()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->insertPublic();

        $this->assertFalse($result);
    }

    public function testUpdate()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->updatePublic();

        $this->assertFalse($result);
    }

    public function testEnable()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->enablePublic();

        $this->assertFalse($result);
    }

    public function testDisable()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->disablePublic();

        $this->assertFalse($result);
    }
}

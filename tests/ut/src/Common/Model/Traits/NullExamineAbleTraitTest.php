<?php
namespace Sdk\Common\Model\Traits;

use PHPUnit\Framework\TestCase;

class NullExamineAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullExamineAbleTraitMock::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testApprove()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->approvePublic();

        $this->assertFalse($result);
    }

    public function testReject()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->rejectPublic();

        $this->assertFalse($result);
    }
}

<?php
namespace Sdk\Common\Model\Traits;

use PHPUnit\Framework\TestCase;

class NullTopAbleTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NullTopAbleTraitMock::class)
                           ->setMethods(['resourceNotExist'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testTop()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->topPublic();

        $this->assertFalse($result);
    }

    public function testCancelTop()
    {
         // 为 resourceNotExist() 方法建立预期：该方法被调用一次且返回true。
        $this->stub->expects($this->exactly(1))->method('resourceNotExist')->willReturn(false);

        $result = $this->stub->cancelTopPublic();

        $this->assertFalse($result);
    }
}

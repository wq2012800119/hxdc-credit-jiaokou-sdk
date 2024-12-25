<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class OperateAbleMockAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OperateAbleMockAdapterTraitMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testInsert()
    {
        $object = new MockObject();

        $result = $this->stub->insertPublic($object);

        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        $object = new MockObject();

        $result = $this->stub->updatePublic($object);

        $this->assertTrue($result);
    }

    public function testEnable()
    {
        $object = new MockObject();

        $result = $this->stub->enablePublic($object);

        $this->assertTrue($result);
    }

    public function testDisable()
    {
        $object = new MockObject();

        $result = $this->stub->disablePublic($object);

        $this->assertTrue($result);
    }
}

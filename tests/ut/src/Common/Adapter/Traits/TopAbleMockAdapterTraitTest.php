<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class TopAbleMockAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new TopAbleMockAdapterTraitMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testTop()
    {
        $object = new MockObject();

        $result = $this->stub->topPublic($object);

        $this->assertTrue($result);
    }

    public function testCancelTop()
    {
        $object = new MockObject();

        $result = $this->stub->cancelTopPublic($object);

        $this->assertTrue($result);
    }
}

<?php
namespace Sdk\Common\Adapter\Traits;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\MockObject;

class ExamineAbleMockAdapterTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ExamineAbleMockAdapterTraitMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testApprove()
    {
        $object = new MockObject();

        $result = $this->stub->approvePublic($object);

        $this->assertTrue($result);
    }

    public function testReject()
    {
        $object = new MockObject();

        $result = $this->stub->rejectPublic($object);

        $this->assertTrue($result);
    }
}

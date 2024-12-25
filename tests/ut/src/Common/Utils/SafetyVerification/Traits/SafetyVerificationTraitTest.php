<?php
namespace Sdk\Common\Utils\SafetyVerification\Traits;

use PHPUnit\Framework\TestCase;

class SafetyVerificationTraitTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(SafetyVerificationTraitMock::class)
                           ->setMethods(['csrfVerification'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testSafetyVerification()
    {
        $this->stub->expects($this->exactly(1))->method('csrfVerification')->willReturn(true);

        $result = $this->stub->safetyVerification();

        $this->assertTrue($result);
    }
}

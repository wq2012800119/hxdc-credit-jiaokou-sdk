<?php
namespace Sdk\Log\ApplicationLog\Adapter\ApplicationLog;

use PHPUnit\Framework\TestCase;

class ApplicationLogMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ApplicationLogMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIApplicationLogAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Adapter\ApplicationLog\IApplicationLogAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Model\ApplicationLog',
            $this->stub->fetchObject(1)
        );
    }
}

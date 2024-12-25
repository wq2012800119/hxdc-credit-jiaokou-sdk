<?php
namespace Sdk\Log\ApplicationLog\Repository;

use PHPUnit\Framework\TestCase;

class ApplicationLogRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ApplicationLogRepository();
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

    public function testExtendsCommonRepository()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Repository\CommonRepository',
            $this->stub
        );
    }

    public function testGetActualAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Adapter\ApplicationLog\ApplicationLogRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Adapter\ApplicationLog\ApplicationLogMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}

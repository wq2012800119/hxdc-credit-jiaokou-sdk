<?php
namespace Sdk\Log\ApplicationLog\Model;

use PHPUnit\Framework\TestCase;

class NullApplicationLogTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullApplicationLog::getInstance();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsINull()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub
        );
    }

    public function testExtendsApplicationLog()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Model\ApplicationLog',
            $this->stub
        );
    }
}

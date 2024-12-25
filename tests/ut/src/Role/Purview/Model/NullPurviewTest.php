<?php
namespace Sdk\Role\Purview\Model;

use PHPUnit\Framework\TestCase;

class NullPurviewTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullPurview::getInstance();
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

    public function testExtendsPurview()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Purview\Model\Purview',
            $this->stub
        );
    }
}

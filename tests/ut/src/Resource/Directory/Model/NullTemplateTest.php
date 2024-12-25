<?php
namespace Sdk\Resource\Directory\Model;

use PHPUnit\Framework\TestCase;

class NullTemplateTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullTemplate::getInstance();
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

    public function testExtendsTemplate()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Template',
            $this->stub
        );
    }
}

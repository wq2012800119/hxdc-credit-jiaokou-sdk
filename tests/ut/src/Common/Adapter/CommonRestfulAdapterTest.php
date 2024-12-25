<?php
namespace Sdk\Common\Adapter;

use PHPUnit\Framework\TestCase;

class CommonRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CommonRestfulAdapterMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsGuzzleAdapter()
    {
        $this->assertInstanceOf(
            'Marmot\Basecode\Adapter\Restful\GuzzleAdapter',
            $this->stub
        );
    }

    public function testGetTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->stub->getTranslatorPublic()
        );

        $this->assertInstanceOf(
            'Sdk\Common\Translator\MockRestfulTranslatorAdapter',
            $this->stub->getTranslatorPublic()
        );
    }

    public function testGetResource()
    {
        $this->assertEquals('tests', $this->stub->getResourcePublic());
    }
}

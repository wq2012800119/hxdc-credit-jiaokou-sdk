<?php
namespace Sdk\Dictionary\Item\Adapter\Item;

use PHPUnit\Framework\TestCase;

class ItemMockAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ItemMockAdapter();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIItemAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Adapter\Item\IItemAdapter',
            $this->stub
        );
    }

    public function testFetchObject()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\Item',
            $this->stub->fetchObject(1)
        );
    }
}

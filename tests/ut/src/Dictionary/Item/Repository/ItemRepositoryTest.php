<?php
namespace Sdk\Dictionary\Item\Repository;

use PHPUnit\Framework\TestCase;

class ItemRepositoryTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ItemRepository();
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
            'Sdk\Dictionary\Item\Adapter\Item\ItemRestfulAdapter',
            $this->stub->getActualAdapter()
        );
    }

    public function testGetMockAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Adapter\Item\ItemMockAdapter',
            $this->stub->getMockAdapter()
        );
    }
}

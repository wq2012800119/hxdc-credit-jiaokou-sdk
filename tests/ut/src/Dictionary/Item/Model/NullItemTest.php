<?php
namespace Sdk\Dictionary\Item\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class NullItemTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = NullItem::getInstance();
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

    public function testExtendsItem()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Item\Model\Item',
            $this->stub
        );
    }

    public function testResourceNotExist()
    {
        $stub = new NullItemMock();

        $result = $stub->resourceNotExistPublic();
        $this->assertFalse($result);
        $this->assertEquals(RESOURCE_NOT_EXIST, Core::getLastError()->getId());
    }
}

<?php
namespace Sdk\Resource\Directory\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

class DirectorySnapshotTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectorySnapshot();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsDirectory()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $this->stub
        );
    }

    /**
     * DirectorySnapshot 领域对象,测试构造函数
     */
    public function testDirectoryConstructor()
    {
        $this->assertEmpty($this->stub->getDirectoryId());
    }

    //directoryId 测试 -------------------------------------------------------- start
    /**
     * 设置 DirectorySnapshot setDirectoryId() 正确的传参类型,期望传值正确
     */
    public function testSetDirectoryIdCorrectType()
    {
        $this->stub->setDirectoryId(1);
        $this->assertEquals(1, $this->stub->getDirectoryId());
    }

    /**
     * 设置 Directory setDirectoryId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDirectoryIdWrongType()
    {
        $this->stub->setDirectoryId(array('directoryId'));
    }
    //directoryId 测试 --------------------------------------------------------   end

    protected function initOperation($method)
    {
        $result = $this->stub->$method();
        $this->assertFalse($result);
        $this->assertEquals(METHOD_NOT_ALLOWED, Core::getLastError()->getId());
    }

    public function testInsert()
    {
        $this->initOperation('insert');
    }

    public function testUpdate()
    {
        $this->initOperation('update');
    }

    public function testEnable()
    {
        $this->initOperation('enable');
    }

    public function testDisable()
    {
        $this->initOperation('disable');
    }

    public function testApprove()
    {
        $this->initOperation('approve');
    }

    public function testReject()
    {
        $this->initOperation('reject');
    }
}

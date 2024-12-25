<?php
namespace Sdk\Resource\Directory\Model;

use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    private $templateStub;

    protected function setUp(): void
    {
        $this->templateStub = new Template();
    }

    protected function tearDown(): void
    {
        unset($this->templateStub);
    }

    /**
     * Template 领域对象,测试构造函数
     */
    public function testTemplateConstructor()
    {
        $this->assertEmpty($this->templateStub->getId());
        $this->assertEmpty($this->templateStub->getName());
        $this->assertEmpty($this->templateStub->getPath());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Directory setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->templateStub->setId(1);
        $this->assertEquals(1, $this->templateStub->getId());
    }

    /**
     * 设置 Directory setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->templateStub->setId('1');
        $this->assertTrue(is_int($this->templateStub->getId()));
        $this->assertEquals(1, $this->templateStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //name 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setName() 正确的传参类型,期望传值正确
     */
    public function testSetNameCorrectType()
    {
        $this->templateStub->setName('templateName');
        $this->assertEquals('templateName', $this->templateStub->getName());
    }

    /**
     * 设置 Directory setName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetNameWrongType()
    {
        $this->templateStub->setName(array('templateName'));
    }
    //name 测试 --------------------------------------------------------   end

    //path 测试 -------------------------------------------------------- start
    /**
     * 设置 Directory setPath() 正确的传参类型,期望传值正确
     */
    public function testSetPathCorrectType()
    {
        $this->templateStub->setPath('path');
        $this->assertEquals('path', $this->templateStub->getPath());
    }

    /**
     * 设置 Directory setPath() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPathWrongType()
    {
        $this->templateStub->setPath(array('path'));
    }
    //path 测试 --------------------------------------------------------   end
}

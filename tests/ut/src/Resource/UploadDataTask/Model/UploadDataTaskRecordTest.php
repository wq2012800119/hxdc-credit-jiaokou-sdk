<?php
namespace Sdk\Resource\UploadDataTask\Model;

use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class UploadDataTaskRecordTest extends TestCase
{
    private $recordStub;

    protected function setUp(): void
    {
        $this->recordStub = new UploadDataTaskRecord();
    }

    protected function tearDown(): void
    {
        unset($this->recordStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->recordStub
        );
    }

    /**
     * UploadDataTaskRecord 领域对象,测试构造函数
     */
    public function testUploadDataTaskRecordConstructor()
    {
        $this->assertEmpty($this->recordStub->getId());
        $this->assertEmpty($this->recordStub->getIndex());
        $this->assertEmpty($this->recordStub->getItems());
        $this->assertEmpty($this->recordStub->getErrorDescription());
        $this->assertEmpty($this->recordStub->getFailReason());
        $this->assertEmpty($this->recordStub->getErrorNumber());
        $this->assertEmpty($this->recordStub->getStatus());
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTask',
            $this->recordStub->getUploadDataTask()
        );
        $this->assertEmpty($this->recordStub->getCreateTime());
        $this->assertEmpty($this->recordStub->getUpdateTime());
        $this->assertEmpty($this->recordStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->recordStub->setId(1);
        $this->assertEquals(1, $this->recordStub->getId());
    }

    /**
     * 设置 UploadDataTaskRecord setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->recordStub->setId('1');
        $this->assertTrue(is_int($this->recordStub->getId()));
        $this->assertEquals(1, $this->recordStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //index 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setIndex() 正确的传参类型,期望传值正确
     */
    public function testSetIndexCorrectType()
    {
        $this->recordStub->setIndex(3);
        $this->assertEquals(3, $this->recordStub->getIndex());
    }

    /**
     * 设置 UploadDataTaskRecord setIndex() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIndexWrongType()
    {
        $this->recordStub->setIndex(array('index'));
    }
    //index 测试 --------------------------------------------------------   end

    //errorNumber 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setErrorNumber() 正确的传参类型,期望传值正确
     */
    public function testSetErrorNumberCorrectType()
    {
        $this->recordStub->setErrorNumber(3);
        $this->assertEquals(3, $this->recordStub->getErrorNumber());
    }

    /**
     * 设置 UploadDataTaskRecord setErrorNumber() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetErrorNumberWrongType()
    {
        $this->recordStub->setErrorNumber(array('errorNumber'));
    }
    //errorNumber 测试 --------------------------------------------------------   end

    //items 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setItems() 正确的传参类型,期望传值正确
     */
    public function testSetItemsCorrectType()
    {
        $this->recordStub->setItems(array('items'));
        $this->assertEquals(array('items'), $this->recordStub->getItems());
    }

    /**
     * 设置 UploadDataTaskRecord setItems() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetItemsWrongType()
    {
        $this->recordStub->setItems('items');
    }
    //items 测试 --------------------------------------------------------   end

    //errorDescription 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setErrorDescription() 正确的传参类型,期望传值正确
     */
    public function testSetErrorDescriptionCorrectType()
    {
        $this->recordStub->setErrorDescription(array('errorDescription'));
        $this->assertEquals(array('errorDescription'), $this->recordStub->getErrorDescription());
    }

    /**
     * 设置 UploadDataTaskRecord setErrorDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetErrorDescriptionWrongType()
    {
        $this->recordStub->setErrorDescription('errorDescription');
    }
    //errorDescription 测试 --------------------------------------------------------   end

    //failReason 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setFailReason() 正确的传参类型,期望传值正确
     */
    public function testSetFailReasonCorrectType()
    {
        $this->recordStub->setFailReason(array('failReason'));
        $this->assertEquals(array('failReason'), $this->recordStub->getFailReason());
    }

    /**
     * 设置 UploadDataTaskRecord setFailReason() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFailReasonWrongType()
    {
        $this->recordStub->setFailReason('failReason');
    }
    //failReason 测试 --------------------------------------------------------   end

    //uploadDataTask 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setUploadDataTask() 正确的传参类型,期望传值正确
     */
    public function testSetUploadDataTaskCorrectType()
    {
        $uploadDataTask = new UploadDataTask();
        $this->recordStub->setUploadDataTask($uploadDataTask);
        $this->assertEquals($uploadDataTask, $this->recordStub->getUploadDataTask());
    }

    /**
     * 设置 UploadDataTaskRecord setUploadDataTask() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUploadDataTaskWrongType()
    {
        $this->recordStub->setUploadDataTask(array('uploadDataTask'));
    }
    //uploadDataTask 测试 --------------------------------------------------------   end

    //status 测试 -------------------------------------------------------- start
    /**
     * 设置 UploadDataTaskRecord setStatus() 正确的传参类型,期望传值正确
     */
    public function testSetStatusCorrectType()
    {
        $this->recordStub->setStatus(1);
        $this->assertEquals(1, $this->recordStub->getStatus());
    }

    /**
     * 设置 UploadDataTaskRecord setStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStatusWrongType()
    {
        $this->recordStub->setStatus(array(1,2,3));
    }
    //status 测试 --------------------------------------------------------   end
}

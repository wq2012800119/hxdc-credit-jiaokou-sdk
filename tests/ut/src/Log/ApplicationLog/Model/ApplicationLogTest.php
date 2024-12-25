<?php
namespace Sdk\Log\ApplicationLog\Model;

use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ApplicationLogTest extends TestCase
{
    private $log;

    protected function setUp(): void
    {
        $this->log = new ApplicationLog();
    }

    protected function tearDown(): void
    {
        unset($this->log);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->log
        );
    }

    /**
     * ApplicationLog 领域对象,测试构造函数
     */
    public function testApplicationLogConstructor()
    {
        $this->assertEmpty($this->log->getId());
        $this->assertEmpty($this->log->getOperatorId());
        $this->assertEmpty($this->log->getOperatorIdentify());
        $this->assertEmpty($this->log->getOperatorCategory());
        $this->assertEmpty($this->log->getTargetCategory());
        $this->assertEmpty($this->log->getTargetAction());
        $this->assertEmpty($this->log->getTargetId());
        $this->assertEmpty($this->log->getTargetName());
        $this->assertEmpty($this->log->getDescription());
        $this->assertEmpty($this->log->getErrorId());
        $this->assertEmpty($this->log->getStatus());
        $this->assertEmpty($this->log->getCreateTime());
        $this->assertEmpty($this->log->getUpdateTime());
        $this->assertEmpty($this->log->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->log->setId(1);
        $this->assertEquals(1, $this->log->getId());
    }

    /**
     * 设置 ApplicationLog setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->log->setId('1');
        $this->assertTrue(is_int($this->log->getId()));
        $this->assertEquals(1, $this->log->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //operatorId 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setOperatorId() 正确的传参类型,期望传值正确
     */
    public function testSetOperatorIdCorrectType()
    {
        $this->log->setOperatorId(1);
        $this->assertEquals(1, $this->log->getOperatorId());
    }

    /**
     * 设置 ApplicationLog setOperatorId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOperatorIdWrongType()
    {
        $this->log->setOperatorId(array(1,2,3));
    }
    //operatorId 测试 --------------------------------------------------------   end

    //operatorIdentify 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setOperatorIdentify() 正确的传参类型,期望传值正确
     */
    public function testSetOperatorIdentifyCorrectType()
    {
        $this->log->setOperatorIdentify('string');
        $this->assertEquals('string', $this->log->getOperatorIdentify());
    }

    /**
     * 设置 ApplicationLog setOperatorIdentify() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOperatorIdentifyWrongType()
    {
        $this->log->setOperatorIdentify(array(1,2,3));
    }
    //operatorIdentify 测试 --------------------------------------------------------   end

    //operatorCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setOperatorCategory() 正确的传参类型,期望传值正确
     */
    public function testSetOperatorCategoryCorrectType()
    {
        $this->log->setOperatorCategory(1);
        $this->assertEquals(1, $this->log->getOperatorCategory());
    }

    /**
     * 设置 ApplicationLog setOperatorCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOperatorCategoryWrongType()
    {
        $this->log->setOperatorCategory(array(1,2,3));
    }
    //operatorCategory 测试 --------------------------------------------------------   end

    //targetCategory 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setTargetCategory() 正确的传参类型,期望传值正确
     */
    public function testSetTargetCategoryCorrectType()
    {
        $this->log->setTargetCategory(1);
        $this->assertEquals(1, $this->log->getTargetCategory());
    }

    /**
     * 设置 ApplicationLog setTargetCategory() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTargetCategoryWrongType()
    {
        $this->log->setTargetCategory(array(1,2,3));
    }
    //targetCategory 测试 --------------------------------------------------------   end

    //targetAction 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setTargetAction() 正确的传参类型,期望传值正确
     */
    public function testSetTargetActionCorrectType()
    {
        $this->log->setTargetAction(1);
        $this->assertEquals(1, $this->log->getTargetAction());
    }

    /**
     * 设置 ApplicationLog setTargetAction() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTargetActionWrongType()
    {
        $this->log->setTargetAction(array(1,2,3));
    }
    //targetAction 测试 --------------------------------------------------------   end

    //targetId 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setTargetId() 正确的传参类型,期望传值正确
     */
    public function testSetTargetIdCorrectType()
    {
        $this->log->setTargetId(1);
        $this->assertEquals(1, $this->log->getTargetId());
    }

    /**
     * 设置 ApplicationLog setTargetId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTargetIdWrongType()
    {
        $this->log->setTargetId(array(1,2,3));
    }
    //targetId 测试 --------------------------------------------------------   end

    //errorId 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setErrorId() 正确的传参类型,期望传值正确
     */
    public function testSetErrorIdCorrectType()
    {
        $this->log->setErrorId(1);
        $this->assertEquals(1, $this->log->getErrorId());
    }

    /**
     * 设置 ApplicationLog setErrorId() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetErrorIdWrongType()
    {
        $this->log->setErrorId(array(1,2,3));
    }
    //errorId 测试 --------------------------------------------------------   end

    //targetName 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setTargetName() 正确的传参类型,期望传值正确
     */
    public function testSetTargetNameCorrectType()
    {
        $this->log->setTargetName('string');
        $this->assertEquals('string', $this->log->getTargetName());
    }

    /**
     * 设置 ApplicationLog setTargetName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTargetNameWrongType()
    {
        $this->log->setTargetName(array(1,2,3));
    }
    //targetName 测试 --------------------------------------------------------   end

    //description 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setDescription() 正确的传参类型,期望传值正确
     */
    public function testSetDescriptionCorrectType()
    {
        $this->log->setDescription('string');
        $this->assertEquals('string', $this->log->getDescription());
    }

    /**
     * 设置 ApplicationLog setDescription() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDescriptionWrongType()
    {
        $this->log->setDescription(array(1,2,3));
    }
    //description 测试 --------------------------------------------------------   end

    //status 测试 -------------------------------------------------------- start
    /**
     * 设置 ApplicationLog setStatus() 正确的传参类型,期望传值正确
     */
    public function testSetStatusCorrectType()
    {
        $this->log->setStatus(1);
        $this->assertEquals(1, $this->log->getStatus());
    }

    /**
     * 设置 ApplicationLog setStatus() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetStatusWrongType()
    {
        $this->log->setStatus(array(1,2,3));
    }
    //status 测试 --------------------------------------------------------   end
}

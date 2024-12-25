<?php
namespace Sdk\User\Model;

use PHPUnit\Framework\TestCase;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class UserTest extends TestCase
{
    private $userStub;

    protected function setUp(): void
    {
        $this->userStub = new UserMock();
    }

    protected function tearDown(): void
    {
        unset($this->userStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->userStub
        );
    }

    public function testImplementsIOperateAble()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Model\Interfaces\IOperateAble',
            $this->userStub
        );
    }

    /**
     * User 领域对象,测试构造函数
     */
    public function testUserConstructor()
    {
        $this->assertEmpty($this->userStub->getId());
        $this->assertEmpty($this->userStub->getSubjectName());
        $this->assertEmpty($this->userStub->getCellphone());
        $this->assertEmpty($this->userStub->getIdCard());
        $this->assertEmpty($this->userStub->getOldPassword());
        $this->assertEmpty($this->userStub->getPassword());
        $this->assertEquals(User::STATUS['ENABLED'], $this->userStub->getStatus());
        $this->assertEmpty($this->userStub->getCreateTime());
        $this->assertEmpty($this->userStub->getUpdateTime());
        $this->assertEmpty($this->userStub->getStatusTime());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 User setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->userStub->setId(4);
        $this->assertEquals(4, $this->userStub->getId());
    }

    /**
     * 设置 User setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->userStub->setId('1');
        $this->assertTrue(is_int($this->userStub->getId()));
        $this->assertEquals(1, $this->userStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //subjectName 测试 -------------------------------------------------------- start
    /**
     * 设置 User setSubjectName() 正确的传参类型,期望传值正确
     */
    public function testSetSubjectNameCorrectType()
    {
        $this->userStub->setSubjectName('subjectName');
        $this->assertEquals('subjectName', $this->userStub->getSubjectName());
    }

    /**
     * 设置 User setSubjectName() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSubjectNameWrongType()
    {
        $this->userStub->setSubjectName(array('subjectName'));
    }
    //subjectName 测试 --------------------------------------------------------   end

    //cellphone 测试 -------------------------------------------------------- start
    /**
     * 设置 User setCellphone() 正确的传参类型,期望传值正确
     */
    public function testSetCellphoneCorrectType()
    {
        $this->userStub->setCellphone('cellphone');
        $this->assertEquals('cellphone', $this->userStub->getCellphone());
    }

    /**
     * 设置 User setCellphone() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCellphoneWrongType()
    {
        $this->userStub->setCellphone(array('cellphone'));
    }
    //cellphone 测试 --------------------------------------------------------   end

    //idCard 测试 -------------------------------------------------------- start
    /**
     * 设置 User setIdCard() 正确的传参类型,期望传值正确
     */
    public function testSetIdCardCorrectType()
    {
        $this->userStub->setIdCard('idCard');
        $this->assertEquals('idCard', $this->userStub->getIdCard());
    }

    /**
     * 设置 User setIdCard() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdCardWrongType()
    {
        $this->userStub->setIdCard(array('idCard'));
    }
    //idCard 测试 --------------------------------------------------------   end

    //password 测试 -------------------------------------------------------- start
    /**
     * 设置 User setPassword() 正确的传参类型,期望传值正确
     */
    public function testSetPasswordCorrectType()
    {
        $this->userStub->setPassword('password');
        $this->assertEquals('password', $this->userStub->getPassword());
    }

    /**
     * 设置 User setPassword() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPasswordWrongType()
    {
        $this->userStub->setPassword(array('password'));
    }
    //password 测试 --------------------------------------------------------   end
    //oldPassword 测试 -------------------------------------------------------- start
    /**
     * 设置 User setOldPassword() 正确的传参类型,期望传值正确
     */
    public function testSetOldPasswordCorrectType()
    {
        $this->userStub->setOldPassword('oldPassword');
        $this->assertEquals('oldPassword', $this->userStub->getOldPassword());
    }

    /**
     * 设置 User setOldPassword() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetOldPasswordWrongType()
    {
        $this->userStub->setOldPassword(array('oldPassword'));
    }
    //oldPassword 测试 --------------------------------------------------------   end
}

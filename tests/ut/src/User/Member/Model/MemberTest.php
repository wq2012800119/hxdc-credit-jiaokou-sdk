<?php
namespace Sdk\User\Member\Model;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Repository\MemberRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MemberTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(MemberMock::class)
                           ->setMethods(['getRepository', 'getMemberCookieAuth'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsUser()
    {
        $this->assertInstanceOf(
            'Sdk\User\Model\User',
            $this->stub
        );
    }

    /**
     * Member 领域对象,测试构造函数
     */
    public function testMemberConstructor()
    {
        $this->assertEmpty($this->stub->getGender());
        $this->assertEmpty($this->stub->getEmail());
        $this->assertEmpty($this->stub->getAddress());
        $this->assertEmpty($this->stub->getQuestion());
        $this->assertEmpty($this->stub->getIdentification());
        $this->assertEmpty($this->stub->getAnswer());
    }

    //gender 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setGender() 正确的传参类型,期望传值正确
     */
    public function testSetGenderCorrectType()
    {
        $this->stub->setGender(1);
        $this->assertEquals(1, $this->stub->getGender());
    }

    /**
     * 设置 Member setGender() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetGenderWrongType()
    {
        $this->stub->setGender(array('memberGender'));
    }
    //gender 测试 --------------------------------------------------------   end

    //identification 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setIdentification() 正确的传参类型,期望传值正确
     */
    public function testSetIdentificationCorrectType()
    {
        $this->stub->setIdentification('memberIdentification');
        $this->assertEquals('memberIdentification', $this->stub->getIdentification());
    }

    /**
     * 设置 Member setIdentification() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdentificationWrongType()
    {
        $this->stub->setIdentification(array('memberIdentification'));
    }
    //identification 测试 --------------------------------------------------------   end

    //email 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setEmail() 正确的传参类型,期望传值正确
     */
    public function testSetEmailCorrectType()
    {
        $this->stub->setEmail('memberEmail');
        $this->assertEquals('memberEmail', $this->stub->getEmail());
    }

    /**
     * 设置 Member setEmail() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetEmailWrongType()
    {
        $this->stub->setEmail(array('memberEmail'));
    }
    //email 测试 --------------------------------------------------------   end

    //address 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setAddress() 正确的传参类型,期望传值正确
     */
    public function testSetAddressCorrectType()
    {
        $this->stub->setAddress('memberAddress');
        $this->assertEquals('memberAddress', $this->stub->getAddress());
    }

    /**
     * 设置 Member setAddress() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetAddressWrongType()
    {
        $this->stub->setAddress(array('memberAddress'));
    }
    //address 测试 --------------------------------------------------------   end

    //answer 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setAnswer() 正确的传参类型,期望传值正确
     */
    public function testSetAnswerCorrectType()
    {
        $this->stub->setAnswer('memberAnswer');
        $this->assertEquals('memberAnswer', $this->stub->getAnswer());
    }

    /**
     * 设置 Member setAnswer() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetAnswerWrongType()
    {
        $this->stub->setAnswer(array('memberAnswer'));
    }
    //answer 测试 --------------------------------------------------------   end

    //question 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setQuestion() 正确的传参类型,期望传值正确
     */
    public function testSetQuestionCorrectType()
    {
        $this->stub->setQuestion(1);
        $this->assertEquals(1, $this->stub->getQuestion());
    }

    /**
     * 设置 Member setQuestion() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetQuestionWrongType()
    {
        $this->stub->setQuestion(array('memberQuestion'));
    }
    //question 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new MemberMock();
        $this->assertInstanceOf(
            'Sdk\User\Member\Repository\MemberRepository',
            $stub->getRepositoryPublic()
        );
    }

    public function testGetMemberCookieAuth()
    {
        $stub = new MemberMock();
        $this->assertInstanceOf(
            'Sdk\User\Member\Model\MemberCookieAuth',
            $stub->getMemberCookieAuthPublic()
        );
    }

    public function testLogin()
    {
        // 为 MemberRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(MemberRepository::class);
        // 建立预期状况:login() 方法将会被调用一次。
        $repository->login($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        // 为 MemberCookieAuth 类建立预言(prophecy)。
        $memberCookieAuth = $this->prophesize(MemberCookieAuth::class);
        // 建立预期状况:saveCookieAndSaveMemberToCache() 方法将会被调用一次。
        $memberCookieAuth->saveCookieAndSaveMemberToCache($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method(
            'getMemberCookieAuth'
        )->willReturn($memberCookieAuth->reveal());

        $result = $this->stub->login();

        $this->assertTrue($result);
    }

    public function testLogout()
    {
        // 为 MemberCookieAuth 类建立预言(prophecy)。
        $memberCookieAuth = $this->prophesize(MemberCookieAuth::class);
        // 建立预期状况:clearCookieAndMemberToCache() 方法将会被调用一次。
        $memberCookieAuth->clearCookieAndMemberToCache($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method(
            'getMemberCookieAuth'
        )->willReturn($memberCookieAuth->reveal());

        $result = $this->stub->logout();

        $this->assertTrue($result);
    }

    protected function initOperation($method)
    {
        // 为 MemberRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(MemberRepository::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $repository->$method($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $this->stub->$method();

        $this->assertTrue($result);
    }

    public function testResetPassword()
    {
        $this->initOperation('resetPassword');
    }

    public function testUpdatePassword()
    {
        $this->initOperation('updatePassword');
    }

    public function testValidateAnswer()
    {
        $this->initOperation('validateAnswer');
    }

    public function testUpdateSecurityQuestion()
    {
        $this->initOperation('updateSecurityQuestion');
    }

    public function testValidatePassword()
    {
        // 为 MemberRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(MemberRepository::class);
        // 建立预期状况:$login() 方法将会被调用一次。
        $repository->login($this->stub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());

        $result = $this->stub->validatePassword();

        $this->assertTrue($result);
    }
}

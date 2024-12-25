<?php
namespace Sdk\User\Member\Adapter\Member;

use PHPUnit\Framework\TestCase;

use Sdk\User\Member\Model\Member;
use Sdk\User\Member\Translator\MemberRestfulTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MemberRestfulAdapterTest extends TestCase
{
    private $memberStub;

    protected function setUp(): void
    {
        $this->memberStub = $this->getMockBuilder(MemberRestfulAdapterMock::class)
                           ->setMethods([
                               'getTranslator',
                               'post',
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->memberStub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->memberStub
        );
    }

    public function testImplementsIMemberAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\User\Member\Adapter\Member\IMemberAdapter',
            $this->memberStub
        );
    }
    
    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->memberStub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\User\Member\Model\NullMember',
            $this->memberStub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->memberStub->scenario($scenario);

        $this->assertEquals($expect, $this->memberStub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('MEMBER_LIST', MemberRestfulAdapter::SCENARIOS['MEMBER_LIST']),
            array('MEMBER_FETCH_ONE', MemberRestfulAdapter::SCENARIOS['MEMBER_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(MemberRestfulAdapter::MAP_ERROR, $this->memberStub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'subjectName',
            'cellphone',
            'idCard',
            'password',
            'gender',
            'email',
            'address',
            'question',
            'answer'
        ), $this->memberStub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'subjectName',
            'gender',
            'email',
            'address'
        ), $this->memberStub->updateTranslatorKeysPublic());
    }

    private function login(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $member = new Member($id);
        $data = array('data');

        // 为 MemberRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member, array('cellphone', 'password'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->memberStub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->memberStub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->memberStub->expects($this->exactly(1))->method('post')->with($resource.'/login', $data);
        $this->memberStub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->memberStub->expects($this->exactly(1))->method('translateToObject')->willReturn($member);
        }

        return $member;
    }

    public function testLoginTrue()
    {
        $member = $this->login(true);

        $result = $this->memberStub->login($member);

        $this->assertTrue($result);
    }

    public function testLoginFalse()
    {
        $member = $this->login(false);

        $result = $this->memberStub->login($member);

        $this->assertFalse($result);
    }

    private function resetPassword(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $member = new Member($id);
        $data = array('data');

        // 为 MemberRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member, array('password'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->memberStub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->memberStub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->memberStub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/resetPassword', $data);
        $this->memberStub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->memberStub->expects($this->exactly(1))->method('translateToObject')->willReturn($member);
        }

        return $member;
    }

    public function testResetPasswordTrue()
    {
        $member = $this->resetPassword(true);

        $result = $this->memberStub->resetPassword($member);

        $this->assertTrue($result);
    }

    public function testResetPasswordFalse()
    {
        $member = $this->resetPassword(false);

        $result = $this->memberStub->resetPassword($member);

        $this->assertFalse($result);
    }

    private function updatePassword(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $member = new Member($id);
        $data = array('data');

        // 为 MemberRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member, array('password', 'oldPassword'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->memberStub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->memberStub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->memberStub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/password', $data);
        $this->memberStub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->memberStub->expects($this->exactly(1))->method('translateToObject')->willReturn($member);
        }

        return $member;
    }

    public function testUpdatePasswordTrue()
    {
        $member = $this->updatePassword(true);

        $result = $this->memberStub->updatePassword($member);

        $this->assertTrue($result);
    }

    public function testUpdatePasswordFalse()
    {
        $member = $this->updatePassword(false);

        $result = $this->memberStub->updatePassword($member);

        $this->assertFalse($result);
    }

    private function updateSecurityQuestion(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $member = new Member($id);
        $data = array('data');

        // 为 MemberRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member, array('question', 'answer'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->memberStub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->memberStub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->memberStub->expects($this->exactly(1))->method(
            'patch'
        )->with($resource.'/'.$id.'/securityQuestion', $data);
        $this->memberStub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->memberStub->expects($this->exactly(1))->method('translateToObject')->willReturn($member);
        }

        return $member;
    }

    public function testUpdateSecurityQuestionTrue()
    {
        $member = $this->updateSecurityQuestion(true);

        $result = $this->memberStub->updateSecurityQuestion($member);

        $this->assertTrue($result);
    }

    public function testUpdateSecurityQuestionFalse()
    {
        $member = $this->updateSecurityQuestion(false);

        $result = $this->memberStub->updateSecurityQuestion($member);

        $this->assertFalse($result);
    }

    private function validateAnswer(bool $result)
    {
        $id = 1;
        $resource = 'resource';
        $member = new Member($id);
        $data = array('data');

        // 为 MemberRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberRestfulTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member, array('answer'))->shouldBeCalled(1)->willReturn($data);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->memberStub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->memberStub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->memberStub->expects($this->exactly(1))->method(
            'post'
        )->with($resource.'/'.$id.'/validateAnswer', $data);
        $this->memberStub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->memberStub->expects($this->exactly(1))->method('translateToObject')->willReturn($member);
        }

        return $member;
    }

    public function testValidateAnswerTrue()
    {
        $member = $this->validateAnswer(true);

        $result = $this->memberStub->validateAnswer($member);

        $this->assertTrue($result);
    }

    public function testValidateAnswerFalse()
    {
        $member = $this->validateAnswer(false);

        $result = $this->memberStub->validateAnswer($member);

        $this->assertFalse($result);
    }
}

<?php
namespace Sdk\User\Member\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;
use Marmot\Framework\Classes\Cookie;

use Sdk\User\Member\Repository\MemberRepository;
use Sdk\User\Member\Translator\MemberTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MemberCookieAuthTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(MemberCookieAuthMock::class)
                           ->setMethods([
                               'getCookie',
                               'getTranslator',
                               'save',
                               'fetchMember',
                               'get',
                               'getRepository',
                               'clearCookie',
                               'verifyCookie',
                               'del'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsDataCacheQuery()
    {
        $this->assertInstanceOf(
            'Marmot\Framework\Query\DataCacheQuery',
            $this->stub
        );
    }

    /**
     * Member 领域对象,测试构造函数
     */
    public function testMemberConstructor()
    {
        $this->assertEmpty($this->stub->getUid());
        $this->assertEquals(Core::$container->get('cookie.name'), $this->stub->getName());
        $this->assertEquals(Core::$container->get('cookie.domain'), $this->stub->getDomain());
        $this->assertEquals(Core::$container->get('cookie.path'), $this->stub->getPath());
        $this->assertEquals(
            Core::$container->get('time') + MemberCookieAuth::COOKIE_EXPIRATION_TIME,
            $this->stub->getExpire()
        );
    }

    public function testGetName()
    {
        $this->assertIsString($this->stub->getName());
    }

    public function testGetDomain()
    {
        $this->assertIsString($this->stub->getDomain());
    }

    public function testGetPath()
    {
        $this->assertIsString($this->stub->getPath());
    }

    public function testGetExpire()
    {
        $this->assertIsInt($this->stub->getExpire());
    }

    //identify 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setIdentify() 正确的传参类型,期望传值正确
     */
    public function testSetIdentifyCorrectType()
    {
        $this->stub->setIdentify('identify');
        $this->assertEquals('identify', $this->stub->getIdentify());
    }

    /**
     * 设置 Member setIdentify() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetIdentifyWrongType()
    {
        $this->stub->setIdentify(array('identify'));
    }
    //identify 测试 --------------------------------------------------------   end

    //uid 测试 -------------------------------------------------------- start
    /**
     * 设置 Member setUid() 正确的传参类型,期望传值正确
     */
    public function testSetUidCorrectType()
    {
        $this->stub->setUid(1);
        $this->assertEquals(1, $this->stub->getUid());
    }

    /**
     * 设置 Member setUid() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUidWrongType()
    {
        $this->stub->setUid(array('memberUid'));
    }
    //uid 测试 --------------------------------------------------------   end

    public function testGetCookie()
    {
        $stub = new MemberCookieAuthMock();
        $this->assertInstanceOf(
            'Marmot\Framework\Classes\Cookie',
            $stub->getCookiePublic()
        );
    }

    public function testGetRepository()
    {
        $stub = new MemberCookieAuthMock();
        $this->assertInstanceOf(
            'Sdk\User\Member\Repository\MemberRepository',
            $stub->getRepositoryPublic()
        );
    }

    public function testGetTranslator()
    {
        $stub = new MemberCookieAuthMock();
        $this->assertInstanceOf(
            'Sdk\User\Member\Translator\MemberTranslator',
            $stub->getTranslatorPublic()
        );
    }

    public function testSaveCookieAndSaveMemberToCache()
    {
        $stub = $this->getMockBuilder(MemberCookieAuth::class)
                           ->setMethods(['saveCookie', 'saveMemberToCache', 'initMember'])
                           ->getMock();

        $member = new Member(1);

        $stub->expects($this->exactly(1))->method('saveCookie')->with($member)->willReturn(true);
        $stub->expects($this->exactly(1))->method('saveMemberToCache')->with($member)->willReturn(true);
        $stub->expects($this->exactly(1))->method('initMember')->with($member)->willReturn(true);

        $result = $stub->saveCookieAndSaveMemberToCache($member);

        $this->assertTrue($result);
    }

    public function testSaveCookie()
    {
        $member = new Member(1);

        // 为 Cookie( 类建立预言(prophecy)。
        $cookie = $this->prophesize(Cookie::class);
        // 建立预期状况:add() 方法将会被调用一次。
        $cookie->add()->shouldBeCalled(1)->willReturn(true);
        // 为 getCookie() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getCookie')->willReturn($cookie->reveal());

        $result = $this->stub->saveCookiePublic($member);
        $this->assertTrue($result);
    }

    public function testSaveMemberToCache()
    {
        $member = new Member(1);
        $memberArray = array('memberArray');
        $cacheKey = MemberCookieAuth::CACHE_KEY.$member->getId();
        $time = MemberCookieAuth::EXPIRATION_TIME;

        // 为 MemberTranslator( 类建立预言(prophecy)。
        $translator = $this->prophesize(MemberTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($member)->shouldBeCalled(1)->willReturn($memberArray);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('save')->with(
            $cacheKey,
            $memberArray,
            $time
        )->willReturn(true);

        $result = $this->stub->saveMemberToCachePublic($member);

        $this->assertTrue($result);
    }

    public function testInitMember()
    {
        $member = new Member(1);

        $result = $this->stub->initMemberPublic($member);

        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('member'), $member);
    }

    public function testVerifyCookieAndInitUserFalse()
    {
        $this->stub->expects($this->exactly(1))->method('verifyCookie')->willReturn(false);

        $result = $this->stub->verifyCookieAndInitUser();

        $this->assertFalse($result);
        $this->assertEquals(Core::$container->get('member'), NullMember::getInstance());
    }

    public function testVerifyCookieAndInitUserTrue()
    {
        $identify = 'identify';
        $member = new Member(1);
        $member->setIdentification($identify);
        $this->stub->setIdentify($identify);
        $this->stub->expects($this->exactly(1))->method('verifyCookie')->willReturn(true);
        $this->stub->expects($this->exactly(1))->method('fetchMember')->willReturn($member);

        $result = $this->stub->verifyCookieAndInitUser();

        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('member'), $member);
    }

    public function testVerifyCookieFalse()
    {
        // 为 Cookie( 类建立预言(prophecy)。
        $cookie = $this->prophesize(Cookie::class);
        // 建立预期状况:get() 方法将会被调用一次。
        $cookie->get()->shouldBeCalled(1);
        // 为 getCookie() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getCookie')->willReturn($cookie->reveal());

        $result = $this->stub->verifyCookiePublic();

        $this->assertFalse($result);
    }

    public function testVerifyCookieTrue()
    {
        // 为 Cookie( 类建立预言(prophecy)。
        $cookie = $this->prophesize(Cookie::class);
        $cookie->value = "1:identify";
        // 建立预期状况:get() 方法将会被调用一次。
        $cookie->get()->shouldBeCalled(1);
        // 为 getCookie() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getCookie')->willReturn($cookie->reveal());

        $result = $this->stub->verifyCookiePublic();

        $this->assertTrue($result);
    }

    public function fetchMember($data)
    {
        $id = 1;
        $this->stub->setUid($id);
        $cacheKey = MemberCookieAuth::CACHE_KEY.$id;
        $member = new Member(1);

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($data);

        if (empty($data)) {
            // 为 MemberRepository 类建立预言(prophecy)。
            $repository = $this->prophesize(MemberRepository::class);

            // 建立预期状况:scenario() 方法将会被调用一次。
            $repository->scenario(
                MemberRepository::FETCH_ONE_MODEL_UN
            )->shouldBeCalledTimes(1)->willReturn($repository->reveal());
            // 建立预期状况:fetchOne() 方法将会被调用一次。
            $repository->fetchOne($id)->shouldBeCalled(1)->willReturn($member);
            // 为 getRepository() 方法建立预期：该方法被调用一次,返回揭示预言。
            $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());
        }

        if (!empty($data)) {
            // 为 MemberTranslator 类建立预言(prophecy)。
            $translator = $this->prophesize(MemberTranslator::class);
            // 建立预期状况:arrayToObject() 方法将会被调用一次。
            $translator->arrayToObject($data)->shouldBeCalled(1)->willReturn($member);
            // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
            $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());
        }

        $result = $this->stub->fetchMemberPublic();
        $this->assertEquals($result, $member);
    }

    public function testFetchMemberEmpty()
    {
        $data = array();

        $this->fetchMember($data);
    }

    public function testFetchMember()
    {
        $data = array('data');

        $this->fetchMember($data);
    }

    public function testClearCookieAndMemberToCache()
    {
        $member = new Member(1);
        $cacheKey = MemberCookieAuth::CACHE_KEY.$member->getId();
        
        $this->stub->expects($this->exactly(1))->method('clearCookie')->willReturn(true);
        $this->stub->expects($this->exactly(1))->method('del')->with($cacheKey)->willReturn(true);

        $result = $this->stub->clearCookieAndMemberToCache($member);
        $this->assertTrue($result);
    }

    public function testClearCookie()
    {
        // 为 Cookie( 类建立预言(prophecy)。
        $cookie = $this->prophesize(Cookie::class);
        // 建立预期状况:add() 方法将会被调用一次。
        $cookie->add()->shouldBeCalled(1)->willReturn(true);
        // 为 getCookie() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getCookie')->willReturn($cookie->reveal());

        $result = $this->stub->clearCookiePublic();
        $this->assertTrue($result);
    }
}

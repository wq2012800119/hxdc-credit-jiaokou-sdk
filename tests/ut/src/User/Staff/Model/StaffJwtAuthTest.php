<?php
namespace Sdk\User\Staff\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\User\Staff\Repository\StaffRepository;
use Sdk\User\Staff\Translator\StaffTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class StaffJwtAuthTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(StaffJwtAuthMock::class)
                           ->setMethods([
                               'getTranslator',
                               'save',
                               'fetchStaff',
                               'get',
                               'getRepository',
                               'fetchJwt',
                               'verifyJwt',
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
     * Staff 领域对象,测试构造函数
     */
    public function testStaffConstructor()
    {
        $this->assertEmpty($this->stub->getUid());
        $this->assertEquals(Core::$container->get('jwt.iss'), $this->stub->getIss());
        $this->assertEquals(Core::$container->get('jwt.sub'), $this->stub->getSub());
        $this->assertEquals(Core::$container->get('jwt.aud'), $this->stub->getAud());
        $this->assertEquals(
            Core::$container->get('time') + StaffJwtAuth::JWT_EXPIRATION_TIME,
            $this->stub->getExp()
        );
        $this->assertEquals(Core::$container->get('time'), $this->stub->getNbf());
        $this->assertEquals(Core::$container->get('time'), $this->stub->getIat());
        $this->assertEquals(Core::$container->get('jwt.key'), $this->stub->getKey());
    }

    public function testGetIss()
    {
        $this->assertIsString($this->stub->getIss());
    }

    public function testGetSub()
    {
        $this->assertIsString($this->stub->getSub());
    }

    public function testGetAud()
    {
        $this->assertIsString($this->stub->getAud());
    }

    public function testGetExp()
    {
        $this->assertIsInt($this->stub->getExp());
    }

    public function testGetNbf()
    {
        $this->assertIsInt($this->stub->getNbf());
    }

    public function testGetIat()
    {
        $this->assertIsInt($this->stub->getIat());
    }

    //jti 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setJti() 正确的传参类型,期望传值正确
     */
    public function testSetJtiCorrectType()
    {
        $this->stub->setJti('jti');
        $this->assertEquals('jti', $this->stub->getJti());
    }

    /**
     * 设置 Staff setJti() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJtiWrongType()
    {
        $this->stub->setJti(array('jti'));
    }
    //jti 测试 --------------------------------------------------------   end

    public function testGetKey()
    {
        $this->assertIsString($this->stub->getKey());
    }

    //uid 测试 -------------------------------------------------------- start
    /**
     * 设置 Staff setUid() 正确的传参类型,期望传值正确
     */
    public function testSetUidCorrectType()
    {
        $this->stub->setUid(1);
        $this->assertEquals(1, $this->stub->getUid());
    }

    /**
     * 设置 Staff setUid() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetUidWrongType()
    {
        $this->stub->setUid(array('staffUid'));
    }
    //uid 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $stub = new StaffJwtAuthMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Repository\StaffRepository',
            $stub->getRepositoryPublic()
        );
    }

    public function testGetTranslator()
    {
        $stub = new StaffJwtAuthMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $stub->getTranslatorPublic()
        );
    }

    public function testGenerateJwtAndSaveStaffToCache()
    {
        $stub = $this->getMockBuilder(StaffJwtAuth::class)
                           ->setMethods(['generateJwt', 'saveStaffToCache', 'initStaff'])
                           ->getMock();

        $staff = new OrganizationUserStaff(1);

        $stub->expects($this->exactly(1))->method('generateJwt')->with($staff)->willReturn(true);
        $stub->expects($this->exactly(1))->method('saveStaffToCache')->with($staff)->willReturn(true);
        $stub->expects($this->exactly(1))->method('initStaff')->with($staff)->willReturn(true);

        $result = $stub->generateJwtAndSaveStaffToCache($staff);

        $this->assertTrue($result);
    }

    public function testGenerateJwt()
    {
        $staff = new OrganizationUserStaff(1);
        $jwt = 'jwt';

        $this->stub->expects($this->exactly(1))->method('fetchJwt')->willReturn($jwt);
        $result = $this->stub->generateJwtPublic($staff);

        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('jwt'), $jwt);
    }

    public function testSaveStaffToCache()
    {
        $staff = new OrganizationUserStaff(1);
        $staffArray = array('staffArray');
        $cacheKey = StaffJwtAuth::CACHE_KEY.$staff->getId();
        $time = StaffJwtAuth::EXPIRATION_TIME;

        // 为 StaffTranslator( 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffTranslator::class);
        // 建立预期状况:objectToArray() 方法将会被调用一次。
        $translator->objectToArray($staff)->shouldBeCalled(1)->willReturn($staffArray);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());

        $this->stub->expects($this->exactly(1))->method('save')->with($cacheKey, $staffArray, $time)->willReturn(true);

        $result = $this->stub->saveStaffToCachePublic($staff);
        $this->assertTrue($result);
    }

    public function testInitStaff()
    {
        $staff = new OrganizationUserStaff(1);

        $result = $this->stub->initStaffPublic($staff);

        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('staff'), $staff);
    }

    public function testVerifyJwtAndInitUserFalse()
    {
        $jwt = 'jwt';
        $this->stub->expects($this->exactly(1))->method('verifyJwt')->with($jwt)->willReturn(false);

        $result = $this->stub->verifyJwtAndInitUser($jwt);

        $this->assertFalse($result);
        $this->assertEquals(Core::$container->get('staff'), NullStaff::getInstance());
    }

    public function testVerifyJwtAndInitUserTrue()
    {
        $jwt = 'jwt';
        $jti = 'jti';
        $staff = new OrganizationUserStaff(1);
        $staff->setIdentification($jti);
        $this->stub->setJti($jti);
        $this->stub->expects($this->exactly(1))->method('verifyJwt')->with($jwt)->willReturn(true);
        $this->stub->expects($this->exactly(1))->method('fetchStaff')->willReturn($staff);

        $result = $this->stub->verifyJwtAndInitUser($jwt);

        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('staff'), $staff);
    }

    public function fetchStaff($data)
    {
        $id = 1;
        $this->stub->setUid($id);
        $cacheKey = StaffJwtAuth::CACHE_KEY.$id;
        $staff = new OrganizationUserStaff(1);

        $this->stub->expects($this->exactly(1))->method('get')->with($cacheKey)->willReturn($data);

        if (empty($data)) {
            // 为 StaffRepository 类建立预言(prophecy)。
            $repository = $this->prophesize(StaffRepository::class);

            // 建立预期状况:scenario() 方法将会被调用一次。
            $repository->scenario(
                StaffRepository::FETCH_ONE_MODEL_UN
            )->shouldBeCalledTimes(1)->willReturn($repository->reveal());
            // 建立预期状况:fetchOne() 方法将会被调用一次。
            $repository->fetchOne($id)->shouldBeCalled(1)->willReturn($staff);
            // 为 getRepository() 方法建立预期：该方法被调用一次,返回揭示预言。
            $this->stub->expects($this->exactly(1))->method('getRepository')->willReturn($repository->reveal());
        }

        if (!empty($data)) {
            // 为 StaffTranslator 类建立预言(prophecy)。
            $translator = $this->prophesize(StaffTranslator::class);
            // 建立预期状况:arrayToObject() 方法将会被调用一次。
            $translator->arrayToObject($data)->shouldBeCalled(1)->willReturn($staff);
            // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
            $this->stub->expects($this->exactly(1))->method('getTranslator')->willReturn($translator->reveal());
        }

        $result = $this->stub->fetchStaffPublic();
        $this->assertEquals($result, $staff);
    }

    public function testFetchStaffEmpty()
    {
        $data = array();

        $this->fetchStaff($data);
    }

    public function testFetchStaff()
    {
        $data = array('data');

        $this->fetchStaff($data);
    }

    public function testClearJwtAndStaffToCache()
    {
        $staff = new OrganizationUserStaff(1);
        $cacheKey = StaffJwtAuth::CACHE_KEY.$staff->getId();

        $this->stub->expects($this->exactly(1))->method('del')->with($cacheKey)->willReturn(true);

        $result = $this->stub->clearJwtAndStaffToCache($staff);
        $this->assertTrue($result);
        $this->assertEquals(Core::$container->get('jwt'), '');
    }
}

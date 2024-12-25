<?php
namespace Sdk\Resource\Enterprise\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Resource\Data\Model\Data;

use Sdk\Resource\Enterprise\Repository\EnterpriseRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class EnterpriseTest extends TestCase
{
    private $enterpriseStub;

    protected function setUp(): void
    {
        $this->enterpriseStub = $this->getMockBuilder(EnterpriseMock::class)
                           ->setMethods(['getRepository', 'isAuthorize'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->enterpriseStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->enterpriseStub
        );
    }

    /**
     * Enterprise 领域对象,测试构造函数
     */
    public function testEnterpriseConstructor()
    {
        $this->assertEmpty($this->enterpriseStub->getId());
        $this->assertEmpty($this->enterpriseStub->getZtmc());
        $this->assertEmpty($this->enterpriseStub->getZtlb());
        $this->assertEmpty($this->enterpriseStub->getTyshxydm());
        $this->assertEmpty($this->enterpriseStub->getFddbr());
        $this->assertEmpty($this->enterpriseStub->getFddbrzjlx());
        $this->assertEmpty($this->enterpriseStub->getFddbrzjhm());
        $this->assertEmpty($this->enterpriseStub->getClrq());
        $this->assertEmpty($this->enterpriseStub->getYxq());
        $this->assertEmpty($this->enterpriseStub->getDz());
        $this->assertEmpty($this->enterpriseStub->getDjjg());
        $this->assertEmpty($this->enterpriseStub->getGb());
        $this->assertEmpty($this->enterpriseStub->getZczb());
        $this->assertEmpty($this->enterpriseStub->getZczbbz());
        $this->assertEmpty($this->enterpriseStub->getHydm());
        $this->assertEmpty($this->enterpriseStub->getLx());
        $this->assertEmpty($this->enterpriseStub->getJyfw());
        $this->assertEmpty($this->enterpriseStub->getJyzt());
        $this->assertEmpty($this->enterpriseStub->getJyfwms());
        $this->assertEmpty($this->enterpriseStub->getAuthorization());
        $this->assertEmpty($this->enterpriseStub->getStatus());
        $this->assertEmpty($this->enterpriseStub->getCreateTime());
        $this->assertEmpty($this->enterpriseStub->getUpdateTime());
        $this->assertEmpty($this->enterpriseStub->getStatusTime());
        $this->assertInstanceOf('Sdk\Resource\Data\Model\Data', $this->enterpriseStub->getSource());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 Enterprise setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->enterpriseStub->setId(1);
        $this->assertEquals(1, $this->enterpriseStub->getId());
    }

    /**
     * 设置 Enterprise setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->enterpriseStub->setId('1');
        $this->assertTrue(is_int($this->enterpriseStub->getId()));
        $this->assertEquals(1, $this->enterpriseStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //ztmc 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setZtmc() 正确的传参类型,期望传值正确
     */
    public function testSetZtmcCorrectType()
    {
        $this->enterpriseStub->setZtmc('enterpriseZtmc');
        $this->assertEquals('enterpriseZtmc', $this->enterpriseStub->getZtmc());
    }

    /**
     * 设置 Enterprise setZtmc() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetZtmcWrongType()
    {
        $this->enterpriseStub->setZtmc(array('enterpriseZtmc'));
    }
    //ztmc 测试 --------------------------------------------------------   end

    //ztlb 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setZtlb() 正确的传参类型,期望传值正确
     */
    public function testSetZtlbCorrectType()
    {
        $this->enterpriseStub->setZtlb(1);
        $this->assertEquals(1, $this->enterpriseStub->getZtlb());
    }

    /**
     * 设置 Enterprise setZtlb() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetZtlbWrongType()
    {
        $this->enterpriseStub->setZtlb('ztlb');
    }
    //ztlb 测试 --------------------------------------------------------   end

    //tyshxydm 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setTyshxydm() 正确的传参类型,期望传值正确
     */
    public function testSetTyshxydmCorrectType()
    {
        $this->enterpriseStub->setTyshxydm('tyshxydm');
        $this->assertEquals('tyshxydm', $this->enterpriseStub->getTyshxydm());
    }

    /**
     * 设置 Enterprise setTyshxydm() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetTyshxydmWrongType()
    {
        $this->enterpriseStub->setTyshxydm(array('tyshxydm'));
    }
    //tyshxydm 测试 --------------------------------------------------------   end

    //fddbr 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setFddbr() 正确的传参类型,期望传值正确
     */
    public function testSetFddbrCorrectType()
    {
        $this->enterpriseStub->setFddbr('fddbr');
        $this->assertEquals('fddbr', $this->enterpriseStub->getFddbr());
    }

    /**
     * 设置 Enterprise setFddbr() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFddbrWrongType()
    {
        $this->enterpriseStub->setFddbr(array('fddbr'));
    }
    //fddbr 测试 --------------------------------------------------------   end

    //fddbrzjlx 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setFddbrzjlx() 正确的传参类型,期望传值正确
     */
    public function testSetFddbrzjlxCorrectType()
    {
        $this->enterpriseStub->setFddbrzjlx('fddbrzjlx');
        $this->assertEquals('fddbrzjlx', $this->enterpriseStub->getFddbrzjlx());
    }

    /**
     * 设置 Enterprise setFddbrzjlx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFddbrzjlxWrongType()
    {
        $this->enterpriseStub->setFddbrzjlx(array('fddbrzjlx'));
    }
    //fddbrzjlx 测试 --------------------------------------------------------   end

    //fddbrzjhm 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setFddbrzjhm() 正确的传参类型,期望传值正确
     */
    public function testSetFddbrzjhmCorrectType()
    {
        $this->enterpriseStub->setFddbrzjhm('fddbrzjhm');
        $this->assertEquals('fddbrzjhm', $this->enterpriseStub->getFddbrzjhm());
    }

    /**
     * 设置 Enterprise setFddbrzjhm() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetFddbrzjhmWrongType()
    {
        $this->enterpriseStub->setFddbrzjhm(array('fddbrzjhm'));
    }
    //fddbrzjhm 测试 --------------------------------------------------------   end

    //clrq 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setClrq() 正确的传参类型,期望传值正确
     */
    public function testSetClrqCorrectType()
    {
        $this->enterpriseStub->setClrq(1);
        $this->assertEquals(1, $this->enterpriseStub->getClrq());
    }

    /**
     * 设置 Enterprise setClrq() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetClrqWrongType()
    {
        $this->enterpriseStub->setClrq(array('clrq'));
    }
    //clrq 测试 --------------------------------------------------------   end

    //yxq 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setYxq() 正确的传参类型,期望传值正确
     */
    public function testSetYxqCorrectType()
    {
        $this->enterpriseStub->setYxq('yxq');
        $this->assertEquals('yxq', $this->enterpriseStub->getYxq());
    }

    /**
     * 设置 Enterprise setYxq() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetYxqWrongType()
    {
        $this->enterpriseStub->setYxq(array('yxq'));
    }
    //yxq 测试 --------------------------------------------------------   end

    //dz 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setDz() 正确的传参类型,期望传值正确
     */
    public function testSetDzCorrectType()
    {
        $this->enterpriseStub->setDz('dz');
        $this->assertEquals('dz', $this->enterpriseStub->getDz());
    }

    /**
     * 设置 Enterprise setDz() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDzWrongType()
    {
        $this->enterpriseStub->setDz(array('dz'));
    }
    //dz 测试 --------------------------------------------------------   end

    //djjg 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setDjjg() 正确的传参类型,期望传值正确
     */
    public function testSetDjjgCorrectType()
    {
        $this->enterpriseStub->setDjjg('djjg');
        $this->assertEquals('djjg', $this->enterpriseStub->getDjjg());
    }

    /**
     * 设置 Enterprise setDjjg() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetDjjgWrongType()
    {
        $this->enterpriseStub->setDjjg(array('djjg'));
    }
    //djjg 测试 --------------------------------------------------------   end

    //gb 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setGb() 正确的传参类型,期望传值正确
     */
    public function testSetGbCorrectType()
    {
        $this->enterpriseStub->setGb('gb');
        $this->assertEquals('gb', $this->enterpriseStub->getGb());
    }

    /**
     * 设置 Enterprise setGb() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetGbWrongType()
    {
        $this->enterpriseStub->setGb(array('gb'));
    }
    //gb 测试 --------------------------------------------------------   end

    //zczb 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setZczb() 正确的传参类型,期望传值正确
     */
    public function testSetzczbCorrectType()
    {
        $this->enterpriseStub->setZczb('zczb');
        $this->assertEquals('zczb', $this->enterpriseStub->getZczb());
    }

    /**
     * 设置 Enterprise setZczb() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetzczbWrongType()
    {
        $this->enterpriseStub->setZczb(array('zczb'));
    }
    //zczb 测试 --------------------------------------------------------   end

    //zczbbz 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setZczbbz() 正确的传参类型,期望传值正确
     */
    public function testSetZczbbzCorrectType()
    {
        $this->enterpriseStub->setZczbbz('zczbbz');
        $this->assertEquals('zczbbz', $this->enterpriseStub->getZczbbz());
    }

    /**
     * 设置 Enterprise setZczbbz() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetZczbbzWrongType()
    {
        $this->enterpriseStub->setZczbbz(array('zczbbz'));
    }
    //zczbbz 测试 --------------------------------------------------------   end

    //hydm 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setHydm() 正确的传参类型,期望传值正确
     */
    public function testSetHydmCorrectType()
    {
        $this->enterpriseStub->setHydm('hydm');
        $this->assertEquals('hydm', $this->enterpriseStub->getHydm());
    }

    /**
     * 设置 Enterprise setHydm() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetHydmWrongType()
    {
        $this->enterpriseStub->setHydm(array('hydm'));
    }
    //hydm 测试 --------------------------------------------------------   end

    //lx 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setLx() 正确的传参类型,期望传值正确
     */
    public function testSetLxCorrectType()
    {
        $this->enterpriseStub->setLx('lx');
        $this->assertEquals('lx', $this->enterpriseStub->getLx());
    }

    /**
     * 设置 Enterprise setLx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetLxWrongType()
    {
        $this->enterpriseStub->setLx(array('lx'));
    }
    //lx 测试 --------------------------------------------------------   end

    //jyfw 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setJyfw() 正确的传参类型,期望传值正确
     */
    public function testSetJyfwCorrectType()
    {
        $this->enterpriseStub->setJyfw('jyfw');
        $this->assertEquals('jyfw', $this->enterpriseStub->getJyfw());
    }

    /**
     * 设置 Enterprise setJyfw() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJyfwWrongType()
    {
        $this->enterpriseStub->setJyfw(array('jyfw'));
    }
    //jyfw 测试 --------------------------------------------------------   end

    //jyzt 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setJyzt() 正确的传参类型,期望传值正确
     */
    public function testSetJyztCorrectType()
    {
        $this->enterpriseStub->setJyzt(1);
        $this->assertEquals(1, $this->enterpriseStub->getJyzt());
    }

    /**
     * 设置 Enterprise setJyzt() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJyztWrongType()
    {
        $this->enterpriseStub->setJyzt(array('jyzt'));
    }
    //jyzt 测试 --------------------------------------------------------   end

    //jyfwms 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setJyfwms() 正确的传参类型,期望传值正确
     */
    public function testSetJyfwmsCorrectType()
    {
        $this->enterpriseStub->setJyfwms('jyfwms');
        $this->assertEquals('jyfwms', $this->enterpriseStub->getJyfwms());
    }

    /**
     * 设置 Enterprise setJyfwms() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJyfwmsWrongType()
    {
        $this->enterpriseStub->setJyfwms(array('jyfwms'));
    }
    //jyfwms 测试 --------------------------------------------------------   end

    //authorization 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setAuthorization() 正确的传参类型,期望传值正确
     */
    public function testSetAuthorizationCorrectType()
    {
        $this->enterpriseStub->setAuthorization(1);
        $this->assertEquals(1, $this->enterpriseStub->getAuthorization());
    }

    /**
     * 设置 Enterprise setAuthorization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetAuthorizationWrongType()
    {
        $this->enterpriseStub->setAuthorization(array('authorization'));
    }
    //authorization 测试 --------------------------------------------------------   end

    //source 测试 -------------------------------------------------------- start
    /**
     * 设置 Enterprise setSource() 正确的传参类型,期望传值正确
     */
    public function testSetSourceCorrectType()
    {
        $source = new Data();
        $this->enterpriseStub->setSource($source);
        $this->assertEquals($source, $this->enterpriseStub->getSource());
    }

    /**
     * 设置 Enterprise setSource() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSourceWrongType()
    {
        $this->enterpriseStub->setSource(array('source'));
    }
    //source 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $enterpriseStub = new EnterpriseMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Repository\EnterpriseRepository',
            $enterpriseStub->getRepositoryPublic()
        );
    }

    protected function initOperation(string $method)
    {
        // 为 EnterpriseRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(EnterpriseRepository::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $repository->$method($this->enterpriseStub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->enterpriseStub->expects($this->once())->method('getRepository')->willReturn($repository->reveal());

        $result = $this->enterpriseStub->$method();

        $this->assertTrue($result);
    }

    public function testAuthorizeFalse()
    {
        $this->enterpriseStub->expects($this->once())->method('isAuthorize')->willReturn(true);

        $this->assertFalse($this->enterpriseStub->authorize());
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testUnAuthorizeFalse()
    {
        $this->enterpriseStub->expects($this->once())->method('isAuthorize')->willReturn(false);

        $this->assertFalse($this->enterpriseStub->unAuthorize());
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testAuthorizeTrue()
    {
        $this->enterpriseStub->expects($this->once())->method('isAuthorize')->willReturn(false);
        $this->initOperation('authorize');
    }

    public function testUnAuthorizeTrue()
    {
        $this->enterpriseStub->expects($this->once())->method('isAuthorize')->willReturn(true);
        $this->initOperation('unAuthorize');
    }

    public function testIsAuthorize()
    {
        $stub = new EnterpriseMock();

        $stub->setAuthorization(Enterprise::AUTHORIZATION['AUTHORIZE']);

        $this->assertTrue($stub->isAuthorize());
    }
}

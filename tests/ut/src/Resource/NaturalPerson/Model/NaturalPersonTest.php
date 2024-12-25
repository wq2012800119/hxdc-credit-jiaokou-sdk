<?php
namespace Sdk\Resource\NaturalPerson\Model;

use Marmot\Core;
use PHPUnit\Framework\TestCase;

use Sdk\Resource\Data\Model\Data;

use Sdk\Resource\NaturalPerson\Repository\NaturalPersonRepository;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class NaturalPersonTest extends TestCase
{
    private $naturalPersonStub;

    protected function setUp(): void
    {
        $this->naturalPersonStub = $this->getMockBuilder(NaturalPersonMock::class)
                           ->setMethods(['getRepository', 'isAuthorize'])
                           ->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->naturalPersonStub);
    }

    public function testImplementsIObject()
    {
        $this->assertInstanceOf(
            'Marmot\Common\Model\IObject',
            $this->naturalPersonStub
        );
    }

    /**
     * NaturalPerson 领域对象,测试构造函数
     */
    public function testNaturalPersonConstructor()
    {
        $this->assertEmpty($this->naturalPersonStub->getId());
        $this->assertEmpty($this->naturalPersonStub->getZtmc());
        $this->assertEmpty($this->naturalPersonStub->getCym());
        $this->assertEmpty($this->naturalPersonStub->getZjhm());
        $this->assertEmpty($this->naturalPersonStub->getXb());
        $this->assertEmpty($this->naturalPersonStub->getCsrq());
        $this->assertEmpty($this->naturalPersonStub->getCssj());
        $this->assertEmpty($this->naturalPersonStub->getCsdgj());
        $this->assertEmpty($this->naturalPersonStub->getCsdssx());
        $this->assertEmpty($this->naturalPersonStub->getJggj());
        $this->assertEmpty($this->naturalPersonStub->getJgssx());
        $this->assertEmpty($this->naturalPersonStub->getSwrq());
        $this->assertEmpty($this->naturalPersonStub->getQcrq());
        $this->assertEmpty($this->naturalPersonStub->getHb());
        $this->assertEmpty($this->naturalPersonStub->getHh());
        $this->assertEmpty($this->naturalPersonStub->getYhzgx());
        $this->assertEmpty($this->naturalPersonStub->getRyzt());
        $this->assertEmpty($this->naturalPersonStub->getPcs());
        $this->assertEmpty($this->naturalPersonStub->getJlx());
        $this->assertEmpty($this->naturalPersonStub->getMlph());
        $this->assertEmpty($this->naturalPersonStub->getMlxz());
        $this->assertEmpty($this->naturalPersonStub->getXzjd());
        $this->assertEmpty($this->naturalPersonStub->getJcwh());
        $this->assertEmpty($this->naturalPersonStub->getMz());
        $this->assertEmpty($this->naturalPersonStub->getAuthorization());
        $this->assertEmpty($this->naturalPersonStub->getStatus());
        $this->assertEmpty($this->naturalPersonStub->getCreateTime());
        $this->assertEmpty($this->naturalPersonStub->getUpdateTime());
        $this->assertEmpty($this->naturalPersonStub->getStatusTime());
        $this->assertInstanceOf('Sdk\Resource\Data\Model\Data', $this->naturalPersonStub->getSource());
    }

    //id 测试 ---------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setId() 正确的传参类型,期望传值正确
     */
    public function testSetIdCorrectType()
    {
        $this->naturalPersonStub->setId(1);
        $this->assertEquals(1, $this->naturalPersonStub->getId());
    }

    /**
     * 设置 NaturalPerson setId() 错误的传参类型.但是传参是数值,期望返回类型正确,值正确.
     */
    public function testSetIdWrongTypeButNumeric()
    {
        $this->naturalPersonStub->setId('1');
        $this->assertTrue(is_int($this->naturalPersonStub->getId()));
        $this->assertEquals(1, $this->naturalPersonStub->getId());
    }
    //id 测试 ----------------------------------------------------------   end

    //ztmc 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setZtmc() 正确的传参类型,期望传值正确
     */
    public function testSetZtmcCorrectType()
    {
        $this->naturalPersonStub->setZtmc('ztmc');
        $this->assertEquals('ztmc', $this->naturalPersonStub->getZtmc());
    }

    /**
     * 设置 NaturalPerson setZtmc() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetZtmcWrongType()
    {
        $this->naturalPersonStub->setZtmc(array('ztmc'));
    }
    //ztmc 测试 --------------------------------------------------------   end

    //cym 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setCym() 正确的传参类型,期望传值正确
     */
    public function testSetCymCorrectType()
    {
        $this->naturalPersonStub->setCym('cym');
        $this->assertEquals('cym', $this->naturalPersonStub->getCym());
    }

    /**
     * 设置 NaturalPerson setCym() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCymWrongType()
    {
        $this->naturalPersonStub->setCym(array('cym'));
    }
    //cym 测试 --------------------------------------------------------   end

    //zjhm 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setZjhm() 正确的传参类型,期望传值正确
     */
    public function testSetZjhmCorrectType()
    {
        $this->naturalPersonStub->setZjhm('zjhm');
        $this->assertEquals('zjhm', $this->naturalPersonStub->getZjhm());
    }

    /**
     * 设置 NaturalPerson setZjhm() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetZjhmWrongType()
    {
        $this->naturalPersonStub->setZjhm(array('zjhm'));
    }
    //zjhm 测试 --------------------------------------------------------   end

    //xb 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setXb() 正确的传参类型,期望传值正确
     */
    public function testSetXbCorrectType()
    {
        $this->naturalPersonStub->setXb('xb');
        $this->assertEquals('xb', $this->naturalPersonStub->getXb());
    }

    /**
     * 设置 NaturalPerson setXb() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetXbWrongType()
    {
        $this->naturalPersonStub->setXb(array('xb'));
    }
    //xb 测试 --------------------------------------------------------   end

    //csrq 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setCsrq() 正确的传参类型,期望传值正确
     */
    public function testSetCsrqCorrectType()
    {
        $this->naturalPersonStub->setCsrq(1);
        $this->assertEquals(1, $this->naturalPersonStub->getCsrq());
    }

    /**
     * 设置 NaturalPerson setCsrq() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCsrqWrongType()
    {
        $this->naturalPersonStub->setCsrq('csrq');
    }
    //csrq 测试 --------------------------------------------------------   end

    //cssj 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setCssj() 正确的传参类型,期望传值正确
     */
    public function testSetCssjCorrectType()
    {
        $this->naturalPersonStub->setCssj('cssj');
        $this->assertEquals('cssj', $this->naturalPersonStub->getCssj());
    }

    /**
     * 设置 NaturalPerson setCssj() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCssjWrongType()
    {
        $this->naturalPersonStub->setCssj(array('cssj'));
    }
    //cssj 测试 --------------------------------------------------------   end

    //csdgj 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setCsdgj() 正确的传参类型,期望传值正确
     */
    public function testSetCsdgjCorrectType()
    {
        $this->naturalPersonStub->setCsdgj('csdgj');
        $this->assertEquals('csdgj', $this->naturalPersonStub->getCsdgj());
    }

    /**
     * 设置 NaturalPerson setCsdgj() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCsdgjWrongType()
    {
        $this->naturalPersonStub->setCsdgj(array('csdgj'));
    }
    //csdgj 测试 --------------------------------------------------------   end

    //csdssx 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setCsdssx() 正确的传参类型,期望传值正确
     */
    public function testSetCsdssxCorrectType()
    {
        $this->naturalPersonStub->setCsdssx('csdssx');
        $this->assertEquals('csdssx', $this->naturalPersonStub->getCsdssx());
    }

    /**
     * 设置 NaturalPerson setCsdssx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetCsdssxWrongType()
    {
        $this->naturalPersonStub->setCsdssx(array('csdssx'));
    }
    //csdssx 测试 --------------------------------------------------------   end

    //jggj 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setJggj() 正确的传参类型,期望传值正确
     */
    public function testSetJggjCorrectType()
    {
        $this->naturalPersonStub->setJggj('jggj');
        $this->assertEquals('jggj', $this->naturalPersonStub->getJggj());
    }

    /**
     * 设置 NaturalPerson setJggj() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJggjWrongType()
    {
        $this->naturalPersonStub->setJggj(array('jggj'));
    }
    //jggj 测试 --------------------------------------------------------   end

    //jgssx 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setJgssx() 正确的传参类型,期望传值正确
     */
    public function testSetJgssxCorrectType()
    {
        $this->naturalPersonStub->setJgssx('jgssx');
        $this->assertEquals('jgssx', $this->naturalPersonStub->getJgssx());
    }

    /**
     * 设置 NaturalPerson setJgssx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJgssxWrongType()
    {
        $this->naturalPersonStub->setJgssx(array('jgssx'));
    }
    //jgssx 测试 --------------------------------------------------------   end

    //swrq 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setSwrq() 正确的传参类型,期望传值正确
     */
    public function testSetSwrqCorrectType()
    {
        $this->naturalPersonStub->setSwrq(1);
        $this->assertEquals(1, $this->naturalPersonStub->getSwrq());
    }

    /**
     * 设置 NaturalPerson setSwrq() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSwrqWrongType()
    {
        $this->naturalPersonStub->setSwrq(array('swrq'));
    }
    //swrq 测试 --------------------------------------------------------   end

    //qcrq 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setQcrq() 正确的传参类型,期望传值正确
     */
    public function testSetQcrqCorrectType()
    {
        $this->naturalPersonStub->setQcrq(1);
        $this->assertEquals(1, $this->naturalPersonStub->getQcrq());
    }

    /**
     * 设置 NaturalPerson setQcrq() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetQcrqWrongType()
    {
        $this->naturalPersonStub->setQcrq(array('qcrq'));
    }
    //qcrq 测试 --------------------------------------------------------   end

    //hb 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setHb() 正确的传参类型,期望传值正确
     */
    public function testSetHbCorrectType()
    {
        $this->naturalPersonStub->setHb('hb');
        $this->assertEquals('hb', $this->naturalPersonStub->getHb());
    }

    /**
     * 设置 NaturalPerson setHb() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetHbWrongType()
    {
        $this->naturalPersonStub->setHb(array('hb'));
    }
    //hb 测试 --------------------------------------------------------   end

    //hh 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setHh() 正确的传参类型,期望传值正确
     */
    public function testSetHhCorrectType()
    {
        $this->naturalPersonStub->setHh('hh');
        $this->assertEquals('hh', $this->naturalPersonStub->getHh());
    }

    /**
     * 设置 NaturalPerson setHh() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetHhWrongType()
    {
        $this->naturalPersonStub->setHh(array('hh'));
    }
    //hh 测试 --------------------------------------------------------   end

    //yhzgx 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setYhzgx() 正确的传参类型,期望传值正确
     */
    public function testSetYhzgxCorrectType()
    {
        $this->naturalPersonStub->setYhzgx('yhzgx');
        $this->assertEquals('yhzgx', $this->naturalPersonStub->getYhzgx());
    }

    /**
     * 设置 NaturalPerson setYhzgx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetYhzgxWrongType()
    {
        $this->naturalPersonStub->setYhzgx(array('yhzgx'));
    }
    //yhzgx 测试 --------------------------------------------------------   end

    //ryzt 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setRyzt() 正确的传参类型,期望传值正确
     */
    public function testSetryztCorrectType()
    {
        $this->naturalPersonStub->setRyzt('ryzt');
        $this->assertEquals('ryzt', $this->naturalPersonStub->getRyzt());
    }

    /**
     * 设置 NaturalPerson setRyzt() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetryztWrongType()
    {
        $this->naturalPersonStub->setRyzt(array('ryzt'));
    }
    //ryzt 测试 --------------------------------------------------------   end

    //pcs 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setPcs() 正确的传参类型,期望传值正确
     */
    public function testSetPcsCorrectType()
    {
        $this->naturalPersonStub->setPcs('pcs');
        $this->assertEquals('pcs', $this->naturalPersonStub->getPcs());
    }

    /**
     * 设置 NaturalPerson setPcs() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetPcsWrongType()
    {
        $this->naturalPersonStub->setPcs(array('pcs'));
    }
    //pcs 测试 --------------------------------------------------------   end

    //jlx 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setJlx() 正确的传参类型,期望传值正确
     */
    public function testSetJlxCorrectType()
    {
        $this->naturalPersonStub->setJlx('jlx');
        $this->assertEquals('jlx', $this->naturalPersonStub->getJlx());
    }

    /**
     * 设置 NaturalPerson setJlx() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJlxWrongType()
    {
        $this->naturalPersonStub->setJlx(array('jlx'));
    }
    //jlx 测试 --------------------------------------------------------   end

    //mlph 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setMlph() 正确的传参类型,期望传值正确
     */
    public function testSetMlphCorrectType()
    {
        $this->naturalPersonStub->setMlph('mlph');
        $this->assertEquals('mlph', $this->naturalPersonStub->getMlph());
    }

    /**
     * 设置 NaturalPerson setMlph() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetMlphWrongType()
    {
        $this->naturalPersonStub->setMlph(array('mlph'));
    }
    //mlph 测试 --------------------------------------------------------   end

    //mlxz 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setMlxz() 正确的传参类型,期望传值正确
     */
    public function testSetMlxzCorrectType()
    {
        $this->naturalPersonStub->setMlxz('mlxz');
        $this->assertEquals('mlxz', $this->naturalPersonStub->getMlxz());
    }

    /**
     * 设置 NaturalPerson setMlxz() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetMlxzWrongType()
    {
        $this->naturalPersonStub->setMlxz(array('mlxz'));
    }
    //mlxz 测试 --------------------------------------------------------   end

    //xzjd 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setXzjd() 正确的传参类型,期望传值正确
     */
    public function testSetXzjdCorrectType()
    {
        $this->naturalPersonStub->setXzjd('xzjd');
        $this->assertEquals('xzjd', $this->naturalPersonStub->getXzjd());
    }

    /**
     * 设置 NaturalPerson setXzjd() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetXzjdWrongType()
    {
        $this->naturalPersonStub->setXzjd(array('xzjd'));
    }
    //xzjd 测试 --------------------------------------------------------   end

    //jcwh 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setJcwh() 正确的传参类型,期望传值正确
     */
    public function testSetJcwhCorrectType()
    {
        $this->naturalPersonStub->setJcwh('jcwh');
        $this->assertEquals('jcwh', $this->naturalPersonStub->getJcwh());
    }

    /**
     * 设置 NaturalPerson setJcwh() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetJcwhWrongType()
    {
        $this->naturalPersonStub->setJcwh(array('jcwh'));
    }
    //jcwh 测试 --------------------------------------------------------   end

    //mz 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setMz() 正确的传参类型,期望传值正确
     */
    public function testSetMzCorrectType()
    {
        $this->naturalPersonStub->setMz('mz');
        $this->assertEquals('mz', $this->naturalPersonStub->getMz());
    }

    /**
     * 设置 NaturalPerson setMz() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetMzWrongType()
    {
        $this->naturalPersonStub->setMz(array('mz'));
    }
    //mz 测试 --------------------------------------------------------   end

    //authorization 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setAuthorization() 正确的传参类型,期望传值正确
     */
    public function testSetAuthorizationCorrectType()
    {
        $this->naturalPersonStub->setAuthorization(1);
        $this->assertEquals(1, $this->naturalPersonStub->getAuthorization());
    }

    /**
     * 设置 NaturalPerson setAuthorization() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetAuthorizationWrongType()
    {
        $this->naturalPersonStub->setAuthorization(array('authorization'));
    }
    //authorization 测试 --------------------------------------------------------   end

    //source 测试 -------------------------------------------------------- start
    /**
     * 设置 NaturalPerson setSource() 正确的传参类型,期望传值正确
     */
    public function testSetSourceCorrectType()
    {
        $source = new Data();
        $this->naturalPersonStub->setSource($source);
        $this->assertEquals($source, $this->naturalPersonStub->getSource());
    }

    /**
     * 设置 NaturalPerson setSource() 错误的传参类型,期望期望抛出TypeError exception
     *
     * @expectedException TypeError
     */
    public function testSetSourceWrongType()
    {
        $this->naturalPersonStub->setSource(array('source'));
    }
    //source 测试 --------------------------------------------------------   end

    public function testGetRepository()
    {
        $naturalPersonStub = new NaturalPersonMock();
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Repository\NaturalPersonRepository',
            $naturalPersonStub->getRepositoryPublic()
        );
    }

    protected function initOperation(string $method)
    {
        // 为 NaturalPersonRepository 类建立预言(prophecy)。
        $repository = $this->prophesize(NaturalPersonRepository::class);
        // 建立预期状况:$method() 方法将会被调用一次。
        $repository->$method($this->naturalPersonStub)->shouldBeCalled(1)->willReturn(true);
        // 为 getTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $this->naturalPersonStub->expects($this->once())->method('getRepository')->willReturn($repository->reveal());

        $result = $this->naturalPersonStub->$method();

        $this->assertTrue($result);
    }

    public function testAuthorizeFalse()
    {
        $this->naturalPersonStub->expects($this->once())->method('isAuthorize')->willReturn(true);

        $this->assertFalse($this->naturalPersonStub->authorize());
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testUnAuthorizeFalse()
    {
        $this->naturalPersonStub->expects($this->once())->method('isAuthorize')->willReturn(false);

        $this->assertFalse($this->naturalPersonStub->unAuthorize());
        $this->assertEquals(RESOURCE_CAN_NOT_MODIFY, Core::getLastError()->getId());
    }

    public function testAuthorizeTrue()
    {
        $this->naturalPersonStub->expects($this->once())->method('isAuthorize')->willReturn(false);
        $this->initOperation('authorize');
    }

    public function testUnAuthorizeTrue()
    {
        $this->naturalPersonStub->expects($this->once())->method('isAuthorize')->willReturn(true);
        $this->initOperation('unAuthorize');
    }

    public function testIsAuthorize()
    {
        $stub = new NaturalPersonMock();

        $stub->setAuthorization(NaturalPerson::AUTHORIZATION['AUTHORIZE']);

        $this->assertTrue($stub->isAuthorize());
    }
}

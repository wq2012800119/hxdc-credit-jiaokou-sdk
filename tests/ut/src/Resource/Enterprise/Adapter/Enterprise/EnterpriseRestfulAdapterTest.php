<?php
namespace Sdk\Resource\Enterprise\Adapter\Enterprise;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Enterprise\Model\Enterprise;

class EnterpriseRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(EnterpriseRestfulAdapterMock::class)
                           ->setMethods([
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsCommonRestfulAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Common\Adapter\CommonRestfulAdapter',
            $this->stub
        );
    }

    public function testImplementsIEnterpriseAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Adapter\Enterprise\IEnterpriseAdapter',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\INull',
            $this->stub->getNullObjectPublic()
        );

        $this->assertInstanceOf(
            'Sdk\Resource\Enterprise\Model\NullEnterprise',
            $this->stub->getNullObjectPublic()
        );
    }

    //scenario
    /**
     * @dataProvider additionProviderScenario
     */
    public function testScenario($scenario, $expect)
    {
        $this->stub->scenario($scenario);

        $this->assertEquals($expect, $this->stub->getScenario());
    }

    public function additionProviderScenario()
    {
        return array(
            array('ENTERPRISE_LIST', EnterpriseRestfulAdapter::SCENARIOS['ENTERPRISE_LIST']),
            array('ENTERPRISE_FETCH_ONE', EnterpriseRestfulAdapter::SCENARIOS['ENTERPRISE_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(EnterpriseRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    private function commonOperationMethod(bool $result, string $method)
    {
        $id = 1;
        $resource = 'resource';
        $enterprise = new Enterprise($id);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/'.$method);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($enterprise);
        }

        return $enterprise;
    }

    public function testAuthorizeTrue()
    {
        $enterprise = $this->commonOperationMethod(true, 'authorize');

        $result = $this->stub->authorize($enterprise);

        $this->assertTrue($result);
    }

    public function testAuthorizeFalse()
    {
        $enterprise = $this->commonOperationMethod(false, 'authorize');

        $result = $this->stub->authorize($enterprise);

        $this->assertFalse($result);
    }

    public function testUnAuthorizeTrue()
    {
        $enterprise = $this->commonOperationMethod(true, 'unAuthorize');

        $result = $this->stub->unAuthorize($enterprise);

        $this->assertTrue($result);
    }

    public function testUnAuthorizeFalse()
    {
        $enterprise = $this->commonOperationMethod(false, 'unAuthorize');

        $result = $this->stub->unAuthorize($enterprise);

        $this->assertFalse($result);
    }
}

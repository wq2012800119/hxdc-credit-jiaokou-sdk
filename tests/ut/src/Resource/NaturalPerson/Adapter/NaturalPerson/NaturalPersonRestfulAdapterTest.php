<?php
namespace Sdk\Resource\NaturalPerson\Adapter\NaturalPerson;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\NaturalPerson\Model\NaturalPerson;

class NaturalPersonRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = $this->getMockBuilder(NaturalPersonRestfulAdapterMock::class)
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

    public function testImplementsINaturalPersonAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\NaturalPerson\Adapter\NaturalPerson\INaturalPersonAdapter',
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
            'Sdk\Resource\NaturalPerson\Model\NullNaturalPerson',
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
            array('NATURAL_PERSON_LIST', NaturalPersonRestfulAdapter::SCENARIOS['NATURAL_PERSON_LIST']),
            array('NATURAL_PERSON_FETCH_ONE', NaturalPersonRestfulAdapter::SCENARIOS['NATURAL_PERSON_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(NaturalPersonRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    private function commonOperationMethod(bool $result, string $method)
    {
        $id = 1;
        $resource = 'resource';
        $naturalPerson = new NaturalPerson($id);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method('patch')->with($resource.'/'.$id.'/'.$method);
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($naturalPerson);
        }

        return $naturalPerson;
    }

    public function testAuthorizeTrue()
    {
        $naturalPerson = $this->commonOperationMethod(true, 'authorize');

        $result = $this->stub->authorize($naturalPerson);

        $this->assertTrue($result);
    }

    public function testAuthorizeFalse()
    {
        $naturalPerson = $this->commonOperationMethod(false, 'authorize');

        $result = $this->stub->authorize($naturalPerson);

        $this->assertFalse($result);
    }

    public function testUnAuthorizeTrue()
    {
        $naturalPerson = $this->commonOperationMethod(true, 'unAuthorize');

        $result = $this->stub->unAuthorize($naturalPerson);

        $this->assertTrue($result);
    }

    public function testUnAuthorizeFalse()
    {
        $naturalPerson = $this->commonOperationMethod(false, 'unAuthorize');

        $result = $this->stub->unAuthorize($naturalPerson);

        $this->assertFalse($result);
    }
}

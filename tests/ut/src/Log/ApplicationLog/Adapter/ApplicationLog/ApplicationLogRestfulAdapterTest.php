<?php
namespace Sdk\Log\ApplicationLog\Adapter\ApplicationLog;

use PHPUnit\Framework\TestCase;

class ApplicationLogRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new ApplicationLogRestfulAdapterMock();
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

    public function testImplementsIApplicationLogAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Log\ApplicationLog\Adapter\ApplicationLog\IApplicationLogAdapter',
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
            'Sdk\Log\ApplicationLog\Model\NullApplicationLog',
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
            array('APPLICATION_LOG_LIST', ApplicationLogRestfulAdapter::SCENARIOS['APPLICATION_LOG_LIST']),
            array('APPLICATION_LOG_FETCH_ONE', ApplicationLogRestfulAdapter::SCENARIOS['APPLICATION_LOG_FETCH_ONE']),
            array('', [])
        );
    }
}

<?php
namespace Sdk\Role\Adapter\Role;

use PHPUnit\Framework\TestCase;

class RoleRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RoleRestfulAdapterMock();
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

    public function testImplementsIRoleAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Role\Adapter\Role\IRoleAdapter',
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
            'Sdk\Role\Model\NullRole',
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
            array('ROLE_LIST', RoleRestfulAdapter::SCENARIOS['ROLE_LIST']),
            array('ROLE_FETCH_ONE', RoleRestfulAdapter::SCENARIOS['ROLE_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(RoleRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'purview'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'purview'
        ), $this->stub->updateTranslatorKeysPublic());
    }
}

<?php
namespace Sdk\Organization\Department\Adapter\Department;

use PHPUnit\Framework\TestCase;

class DepartmentRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DepartmentRestfulAdapterMock();
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

    public function testImplementsIDepartmentAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Department\Adapter\Department\IDepartmentAdapter',
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
            'Sdk\Organization\Department\Model\NullDepartment',
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
            array('DEPARTMENT_LIST', DepartmentRestfulAdapter::SCENARIOS['DEPARTMENT_LIST']),
            array('DEPARTMENT_FETCH_ONE', DepartmentRestfulAdapter::SCENARIOS['DEPARTMENT_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(DepartmentRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array('name', 'organization'), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array('name'), $this->stub->updateTranslatorKeysPublic());
    }
}

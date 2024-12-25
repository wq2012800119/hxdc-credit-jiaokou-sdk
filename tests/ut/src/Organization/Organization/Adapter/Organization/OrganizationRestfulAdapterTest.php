<?php
namespace Sdk\Organization\Organization\Adapter\Organization;

use PHPUnit\Framework\TestCase;

class OrganizationRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new OrganizationRestfulAdapterMock();
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

    public function testImplementsIOrganizationAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Adapter\Organization\IOrganizationAdapter',
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
            'Sdk\Organization\Organization\Model\NullOrganization',
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
            array('ORGANIZATION_LIST', OrganizationRestfulAdapter::SCENARIOS['ORGANIZATION_LIST']),
            array('ORGANIZATION_FETCH_ONE', OrganizationRestfulAdapter::SCENARIOS['ORGANIZATION_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(OrganizationRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'shortName',
            'unifiedIdentifier',
            'jurisdictionArea'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(
            'name',
            'shortName',
            'unifiedIdentifier'
        ), $this->stub->updateTranslatorKeysPublic());
    }
}

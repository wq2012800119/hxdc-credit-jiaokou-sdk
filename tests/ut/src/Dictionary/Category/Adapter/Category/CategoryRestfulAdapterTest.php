<?php
namespace Sdk\Dictionary\Category\Adapter\Category;

use PHPUnit\Framework\TestCase;

class CategoryRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new CategoryRestfulAdapterMock();
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

    public function testImplementsICategoryAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\Dictionary\Category\Adapter\Category\ICategoryAdapter',
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
            'Sdk\Dictionary\Category\Model\NullCategory',
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
            array('CATEGORY_LIST', CategoryRestfulAdapter::SCENARIOS['CATEGORY_LIST']),
            array('CATEGORY_FETCH_ONE', CategoryRestfulAdapter::SCENARIOS['CATEGORY_FETCH_ONE']),
            array('', [])
        );
    }
}

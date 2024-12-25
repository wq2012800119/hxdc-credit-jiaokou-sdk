<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig;

use PHPUnit\Framework\TestCase;

class HelpPageConfigRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigRestfulAdapterMock();
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

    public function testImplementsIHelpPageConfigAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Adapter\HelpPageConfig\IHelpPageConfigAdapter',
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
            'Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig',
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
            array('HELP_PAGE_CONFIG_LIST', HelpPageConfigRestfulAdapter::SCENARIOS['HELP_PAGE_CONFIG_LIST']),
            array('HELP_PAGE_CONFIG_FETCH_ONE', HelpPageConfigRestfulAdapter::SCENARIOS['HELP_PAGE_CONFIG_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(HelpPageConfigRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'title',
            'style',
            'diyContent',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array('title', 'style', 'diyContent'), $this->stub->updateTranslatorKeysPublic());
    }
}

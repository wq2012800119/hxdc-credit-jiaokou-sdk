<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Utils\MockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class HomePageConfigRestfulAdapterTest extends TestCase
{
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigRestfulAdapterMock();
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

    public function testImplementsIHomePageConfigAdapter()
    {
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Adapter\HomePageConfig\IHomePageConfigAdapter',
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
            'Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig',
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
            array('HOME_PAGE_CONFIG_LIST', HomePageConfigRestfulAdapter::SCENARIOS['HOME_PAGE_CONFIG_LIST']),
            array('HOME_PAGE_CONFIG_FETCH_ONE', HomePageConfigRestfulAdapter::SCENARIOS['HOME_PAGE_CONFIG_FETCH_ONE']),
            array('', [])
        );
    }

    public function testGetAlonePossessMapErrors()
    {
        $this->assertEquals(HomePageConfigRestfulAdapter::MAP_ERROR, $this->stub->getAlonePossessMapErrorsPublic());
    }

    public function testInsertTranslatorKeys()
    {
        $this->assertEquals(array(
            'versionDescription',
            'diyContent',
            'status',
            'staff'
        ), $this->stub->insertTranslatorKeysPublic());
    }

    public function testUpdateTranslatorKeys()
    {
        $this->assertEquals(array(), $this->stub->updateTranslatorKeysPublic());
    }

    private function initPublish(bool $result)
    {
        $this->stub = $this->getMockBuilder(HomePageConfigRestfulAdapterMock::class)
                           ->setMethods([
                               'patch',
                               'getResource',
                               'isSuccess',
                               'translateToObject'
                            ])->getMock();

        $resource = 'resource';
        $homePageConfig = MockObjectGenerate::generateHomePageConfig(1);

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method(
            'patch'
        )->with($resource.'/'.$homePageConfig->getId().'/publish');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($homePageConfig);
        }

        return $homePageConfig;
    }

    public function testPublishTrue()
    {
        $homePageConfig = $this->initPublish(true);

        $result = $this->stub->publish($homePageConfig);

        $this->assertTrue($result);
    }

    public function testPublishFalse()
    {
        $homePageConfig = $this->initPublish(false);

        $result = $this->stub->publish($homePageConfig);

        $this->assertFalse($result);
    }

    private function initCurrent(bool $result, HomePageConfig $homePageConfig)
    {
        $this->stub = $this->getMockBuilder(HomePageConfigRestfulAdapterMock::class)
                           ->setMethods([
                               'get',
                               'getResource',
                               'isSuccess',
                               'translateToObject',
                               'getNullObject'
                            ])->getMock();

        $resource = 'resource';

        $this->stub->expects($this->exactly(1))->method('getResource')->willReturn($resource);
        $this->stub->expects($this->exactly(1))->method(
            'get'
        )->with($resource.'/current');
        $this->stub->expects($this->exactly(1))->method('isSuccess')->willReturn($result);

        if ($result) {
            $this->stub->expects($this->exactly(1))->method('translateToObject')->willReturn($homePageConfig);
        }

        if (!$result) {
            $this->stub->expects($this->exactly(1))->method('getNullObject')->willReturn($homePageConfig);
        }
    }

    public function testCurrentTrue()
    {
        $homePageConfig = MockObjectGenerate::generateHomePageConfig(1);
        $this->initCurrent(true, $homePageConfig);

        $result = $this->stub->current();
        $this->assertEquals($result, $homePageConfig);
    }

    public function testCurrentFalse()
    {
        $homePageConfig = NullHomePageConfig::getInstance();

        $homePageConfig = $this->initCurrent(false, $homePageConfig);

        $result = $this->stub->current();
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig',
            $result
        );
    }
}

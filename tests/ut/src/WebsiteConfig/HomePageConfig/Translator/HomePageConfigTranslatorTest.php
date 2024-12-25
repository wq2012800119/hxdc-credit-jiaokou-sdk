<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig;
use Sdk\WebsiteConfig\HomePageConfig\Utils\MockObjectGenerate;
use Sdk\WebsiteConfig\HomePageConfig\Utils\TranslatorUtilsTrait;

class HomePageConfigTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $stub = new HomePageConfigTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $homePageConfig = array();
        $result = $this->stub->objectToArray($homePageConfig);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(HomePageConfigTranslatorMock::class)
                           ->setMethods([
                               'statusFormatConversion',
                               'diyContentFormatConversion'
                            ])->getMock();

        $homePageConfig = MockObjectGenerate::generateHomePageConfig(1);
        $statusArray = array('status');
        $diyContentArray = array('diyContent');

        $stub->expects($this->exactly(1))->method('statusFormatConversion')->with(
            $homePageConfig->getStatus(),
            HomePageConfig::STATUS_TYPE,
            HomePageConfig::HOME_PAGE_CONFIG_STATUS_CN
        )->willReturn($statusArray);
        $stub->expects($this->exactly(1))->method('diyContentFormatConversion')->with(
            $homePageConfig->getDiyContent()
        )->willReturn($diyContentArray);

        $result = $stub->objectToArray($homePageConfig);

        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['diyContent'], $diyContentArray);
        $this->compareTranslatorEquals($result, $homePageConfig);
    }

    public function testDiyContentFormatConversion()
    {
        $stub = new HomePageConfigTranslatorMock();

        $diyContent = array(
            'mainNav' => array(array('articleCategory' => 0)),
            'articleContent' => array(array('category' => 0)),
            'statistics' => array('sgsStatus' => 0, 'hhmdStatus' => 1)
        );

        $diyContentExpect = array(
            'mainNav' => array(array('articleCategory' => marmot_encode(0))),
            'articleContent' => array(array('category' => marmot_encode(0))),
            'statistics' => array('sgsStatus' => 0, 'hhmdStatus' => 1, 'enableStatusCount' => 1)
        );
        
        $result = $stub->diyContentFormatConversionPublic($diyContent);

        $this->assertEquals($result, $diyContentExpect);
    }
}

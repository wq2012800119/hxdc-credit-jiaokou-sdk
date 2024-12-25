<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig;
use Sdk\WebsiteConfig\HelpPageConfig\Utils\MockObjectGenerate;
use Sdk\WebsiteConfig\HelpPageConfig\Utils\TranslatorUtilsTrait;

class HelpPageConfigTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigTranslator();
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
        $stub = new HelpPageConfigTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $helpPageConfig = array();
        $result = $this->stub->objectToArray($helpPageConfig);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(HelpPageConfigTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'diyContentFormatConversion'
                            ])->getMock();

        $helpPageConfig = MockObjectGenerate::generateHelpPageConfig(1);
        $styleArray = array('style');
        $diyContentArray = array('diyContent');

        $stub->expects($this->exactly(1))->method('typeFormatConversion')->with(
            $helpPageConfig->getStyle(),
            HelpPageConfig::STYLE_CN
        )->willReturn($styleArray);
        $stub->expects($this->exactly(1))->method('diyContentFormatConversion')->with(
            $helpPageConfig->getDiyContent()
        )->willReturn($diyContentArray);

        $result = $stub->objectToArray($helpPageConfig);

        $this->assertEquals($result['style'], $styleArray);
        $this->assertEquals($result['diyContent'], $diyContentArray);
        $this->compareTranslatorEquals($result, $helpPageConfig);
    }

    public function testDiyContentFormatConversionStyleOne()
    {
        $stub = new HelpPageConfigTranslatorMock();
        $diyContent = array('diyContent');

        $result = $stub->diyContentFormatConversionPublic($diyContent, HelpPageConfig::STYLE['STYLE_ONE']);

        $this->assertEquals($result, $diyContent);
    }

    public function testDiyContentFormatConversionStyleTwo()
    {
        $stub = new HelpPageConfigTranslatorMock();
        $diyContent = array(
            array(
                'status' => 0,
                'items' => array(
                    array('status' => 0)
                )
            )
        );
        $diyContentExpect = array(
            array(
                'status' => marmot_encode(0),
                'items' => array(
                    array('status' => marmot_encode(0))
                )
            )
        );

        $result = $stub->diyContentFormatConversionPublic($diyContent, HelpPageConfig::STYLE['STYLE_TWO']);

        $this->assertEquals($result, $diyContentExpect);
    }

    public function testDiyContentFormatConversionStyleThree()
    {
        $stub = new HelpPageConfigTranslatorMock();
        $diyContent = array(array('status' => 0));
        $diyContentExpect = array(array('status' => marmot_encode(0)));

        $result = $stub->diyContentFormatConversionPublic($diyContent, HelpPageConfig::STYLE['STYLE_THREE']);

        $this->assertEquals($result, $diyContentExpect);
    }
}

<?php
namespace Sdk\WebsiteConfig\HelpPageConfig\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HelpPageConfig\Utils\MockObjectGenerate;
use Sdk\WebsiteConfig\HelpPageConfig\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

class HelpPageConfigRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HelpPageConfigRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testImplementsIRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->stub
        );
    }

    public function testGetStaffRestfulTranslator()
    {
        $stub = new HelpPageConfigRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\NullHelpPageConfig',
            $result
        );
    }

    public function testArrayToObject()
    {
        $helpPageConfig = MockObjectGenerate::generateHelpPageConfig(1);

        $expression['data']['id'] = $helpPageConfig->getId();
        $expression['data']['attributes']['title'] = $helpPageConfig->getTitle();
        $expression['data']['attributes']['style'] = $helpPageConfig->getStyle();
        $expression['data']['attributes']['content'] = $helpPageConfig->getDiyContent();
        $expression['data']['attributes']['status'] = $helpPageConfig->getStatus();
        $expression['data']['attributes']['statusTime'] = $helpPageConfig->getStatusTime();
        $expression['data']['attributes']['createTime'] = $helpPageConfig->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $helpPageConfig->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $configStub = $this->getMockBuilder(HelpPageConfigRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getStaffRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'staff' => array('staff')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);

        $configStub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $configStub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['staff'], $includedConversion)->willReturn($staffArray);

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $configStub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $configStub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HelpPageConfig\Model\HelpPageConfig',
            $result
        );

        $this->assertEquals($staff, $result->getStaff());
    }

    public function testObjectToArrayEmpty()
    {
        $helpPageConfig = array();
        $result = $this->stub->objectToArray($helpPageConfig);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $helpPageConfig = MockObjectGenerate::generateHelpPageConfig(1);

        $result = $this->stub->objectToArray($helpPageConfig);

        $this->compareRestfulTranslatorEquals($helpPageConfig, $result);
    }
}

<?php
namespace Sdk\WebsiteConfig\HomePageConfig\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\WebsiteConfig\HomePageConfig\Utils\MockObjectGenerate;
use Sdk\WebsiteConfig\HomePageConfig\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

class HomePageConfigRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new HomePageConfigRestfulTranslator();
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
        $stub = new HomePageConfigRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\NullHomePageConfig',
            $result
        );
    }

    public function testArrayToObject()
    {
        $homePageConfig = MockObjectGenerate::generateHomePageConfig(1);

        $expression['data']['id'] = $homePageConfig->getId();
        $expression['data']['attributes']['versionDescription'] = $homePageConfig->getVersionDescription();
        $expression['data']['attributes']['content'] = $homePageConfig->getDiyContent();
        $expression['data']['attributes']['status'] = $homePageConfig->getStatus();
        $expression['data']['attributes']['statusTime'] = $homePageConfig->getStatusTime();
        $expression['data']['attributes']['createTime'] = $homePageConfig->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $homePageConfig->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $homeStub = $this->getMockBuilder(HomePageConfigRestfulTranslatorMock::class)
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

        $homeStub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $homeStub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['staff'], $includedConversion)->willReturn($staffArray);

        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $homeStub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());

        $result = $homeStub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\WebsiteConfig\HomePageConfig\Model\HomePageConfig',
            $result
        );

        $this->assertEquals($staff, $result->getStaff());
    }

    public function testObjectToArrayEmpty()
    {
        $homePageConfig = array();
        $result = $this->stub->objectToArray($homePageConfig);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $homePageConfig = MockObjectGenerate::generateHomePageConfig(1);

        $result = $this->stub->objectToArray($homePageConfig);

        $this->compareRestfulTranslatorEquals($homePageConfig, $result);
    }
}

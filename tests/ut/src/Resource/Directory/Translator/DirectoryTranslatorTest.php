<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Utils\MockObjectGenerate;
use Sdk\Resource\Directory\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DirectoryTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryTranslator();
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

    public function testGetStaffTranslator()
    {
        $stub = new DirectoryTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $stub->getStaffTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $stub = new DirectoryTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetTemplateTranslator()
    {
        $stub = new DirectoryTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\TemplateTranslator',
            $stub->getTemplateTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new DirectoryTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullDirectory',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $directory = array();
        $result = $this->stub->objectToArray($directory);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(DirectoryTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'getOrganizationTranslator',
                               'getTemplateTranslator',
                               'getStaffTranslator'
                            ])->getMock();

        $directory = MockObjectGenerate::generateDirectory(1);
        $directory->setSubjectCategory([Directory::SUBJECT_CATEGORY['FRJFFRZZ']]);
        $directory->setInfoCategory(Directory::INFO_CATEGORY['CSSX']);
        $items = array(
            array(
                'dataType' => Directory::DATA_TYPE['ZFX'],
                'required' => Directory::REQUIRED['NO'],
                'desensitization' => Directory::DESENSITIZATION['YES'],
                'publicationRange' => Directory::PUBLICATION_RANGE['SHGK']
            )
        );
        $directory->setItems($items);
        list(
            $sourceUnitsArray,
            $organizationArray,
            $staffArray,
            $templateArray
        ) = $this->relationObjectToArray($directory, $stub);

        list($subjectCategoryArray, $infoCategoryArray, $itemsArray) = $this->typeFormatConversion($directory, $stub);
        list($statusArray, $examineStatusArray) = $this->statusFormatConversion($directory, $stub);
 
        $result = $stub->objectToArray($directory);

        $this->assertEquals($result['items'], $itemsArray);
        $this->assertEquals($result['subjectCategory'], $subjectCategoryArray);
        $this->assertEquals($result['infoCategory'], $infoCategoryArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['examineStatus'], $examineStatusArray);
        $this->assertEquals($result['sourceUnits'], $sourceUnitsArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['template'], $templateArray);
        $this->assertEquals($result['staff'], $staffArray);
        
        $this->compareTranslatorEquals($result, $directory);
    }

    private function typeFormatConversion(Directory $directory, $stub) : array
    {
        $subjectCategoryArray = array('subjectCategory');
        $infoCategoryArray = array('infoCategory');
        $item = $directory->getItems()[0];
        $itemsArray = array(
            array(
                'dataType' => array('dataType'),
                'required' => array('required'),
                'desensitization' => array('desensitization'),
                'publicationRange' => array('publicationRange')
            )
        );

        $stub->expects($this->exactly(6))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $directory->getSubjectCategory()[0], Directory::SUBJECT_CATEGORY_CN, $subjectCategoryArray
                ],
                [
                    $directory->getInfoCategory(), Directory::INFO_CATEGORY_CN, $infoCategoryArray
                ],
                [
                    $item['dataType'], Directory::DATA_TYPE_CN, array('dataType')
                ],
                [
                    $item['required'], Directory::REQUIRED_CN, array('required')
                ],
                [
                    $item['desensitization'], Directory::DESENSITIZATION_CN, array('desensitization')
                ],
                [
                    $item['publicationRange'], Directory::PUBLICATION_RANGE_CN, array('publicationRange')
                ]
            ]));

        return [[$subjectCategoryArray], $infoCategoryArray, $itemsArray];
    }

    private function statusFormatConversion(Directory $directory, $stub) : array
    {
        $statusArray = array('status');
        $examineStatusArray = array('examineStatus');
        $stub->expects($this->exactly(2))->method('statusFormatConversion')
            ->will($this->returnValueMap([
                [
                    $directory->getStatus(), IOperateAble::STATUS_TYPE, IOperateAble::STATUS_CN, $statusArray
                ],
                [
                    $directory->getExamineStatus(),
                    IExamineAble::EXAMINE_STATUS_TYPE,
                    IExamineAble::EXAMINE_STATUS_CN,
                    $examineStatusArray
                ]
            ]));

        return [$statusArray, $examineStatusArray];
    }

    private function relationObjectToArray(Directory $directory, $stub) : array
    {
        list($sourceUnitsArray, $organizationArray) = $this->organizationRelationObjectToArray($directory, $stub);
        $staffArray = $this->staffRelationObjectToArray($directory, $stub);
        $templateArray = $this->templateRelationObjectToArray($directory, $stub);

        return [$sourceUnitsArray, $organizationArray, $staffArray, $templateArray];
    }

    private function organizationRelationObjectToArray(Directory $directory, $stub) : array
    {
        $sourceUnits = $directory->getSourceUnits();
        $sourceUnitsArray = array('sourceUnitsArray');
        $organization = $directory->getOrganization();
        $organizationArray = array('organizationArray');

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $organization,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($organizationArray);
        $translator->objectToArray(
            $sourceUnits[0],
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($sourceUnitsArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(2))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        return [[$sourceUnitsArray], $organizationArray];
    }

    private function staffRelationObjectToArray(Directory $directory, $stub) : array
    {
        $staff = $directory->getStaff();
        $staffArray = array('staffArray');

        // 为 StaffTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(StaffTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $staff,
            ['id', 'subjectName']
        )->shouldBeCalled(1)->willReturn($staffArray);
        // 为 getStaffTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffTranslator'
        )->willReturn($translator->reveal());

        return $staffArray;
    }

    private function templateRelationObjectToArray(Directory $directory, $stub) : array
    {
        $template = $directory->getTemplate();
        $templateArray = array('templateArray');

        // 为 TemplateTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(TemplateTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $template,
            ['id', 'name', 'path']
        )->shouldBeCalled(1)->willReturn($templateArray);
        // 为 getTemplateTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getTemplateTranslator'
        )->willReturn($translator->reveal());

        return $templateArray;
    }
}

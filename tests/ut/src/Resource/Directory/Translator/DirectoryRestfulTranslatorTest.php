<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Model\Template;
use Sdk\Resource\Directory\Model\Directory;
use Sdk\Resource\Directory\Utils\MockObjectGenerate;
use Sdk\Resource\Directory\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DirectoryRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DirectoryRestfulTranslator();
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
        $stub = new DirectoryRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testGetTemplateRestfulTranslator()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\TemplateRestfulTranslator',
            $stub->getTemplateRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullDirectory',
            $result
        );
    }

    public function testArrayToObject()
    {
        $stub = $this->getMockBuilder(DirectoryRestfulTranslatorMock::class)
                           ->setMethods([
                               'subjectCategorySplit'
                            ])->getMock();

        $directory = MockObjectGenerate::generateDirectory(1);
        $subjectCategorySplit = 1;

        $stub->expects($this->exactly(1))->method('subjectCategorySplit')->with(
            $subjectCategorySplit
        )->willReturn($directory->getSubjectCategory());

        $expression['data']['id'] = $directory->getId();
        $expression['data']['attributes']['name'] = $directory->getName();
        $expression['data']['attributes']['identify'] = $directory->getIdentify();
        $expression['data']['attributes']['subjectCategory'] = $subjectCategorySplit;
        $expression['data']['attributes']['readOnly'] = $directory->getReadOnly();
        $expression['data']['attributes']['infoCategory'] = $directory->getInfoCategory();
        $expression['data']['attributes']['description'] = $directory->getDescription();
        $expression['data']['attributes']['versionNumber'] = $directory->getVersion();
        $expression['data']['attributes']['versionDescription'] = $directory->getVersionDescription();
        $expression['data']['attributes']['items'] = $directory->getItems();
        $expression['data']['attributes']['examineStatus'] = $directory->getExamineStatus();
        $expression['data']['attributes']['status'] = $directory->getStatus();
        $expression['data']['attributes']['statusTime'] = $directory->getStatusTime();
        $expression['data']['attributes']['createTime'] = $directory->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $directory->getUpdateTime();

        $result = $stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $result
        );

        if (isset($expression['data']['attributes']['subjectCategory'])) {
            $this->assertEquals($result->getSubjectCategory(), $directory->getSubjectCategory());
        }
        if (isset($attributes['items'])) {
            $this->assertEquals($attributes['items'], $directory->getItems());
        }
        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(DirectoryRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'relationshipsFill',
                               'getOrganizationRestfulTranslator',
                               'getStaffRestfulTranslator',
                               'getTemplateRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'organization' => array('organization'),
            'staff' => array('staff'),
            'sourceUnits' => array('sourceUnits'),
            'template' => array('directoryTemplate')
        );

        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);

        $sourceUnitArray = array('sourceUnitArray');
        $sourceUnit = OrganizationMockObjectGenerate::generateOrganization(2);
        $sourceUnitsArray = array($sourceUnitArray);

        $directoryTemplateArray = array('directoryTemplateArray');
        $directoryTemplate = new Template(1);

        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);
        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(3))->method('relationshipFill')
            ->will($this->returnValueMap([
                [
                    $relationships['organization'], $includedConversion, $organizationArray
                ],
                [
                    $relationships['staff'], $includedConversion, $staffArray
                ],
                [
                    $relationships['template'], $includedConversion, $directoryTemplateArray
                ]
            ]));
            
        $stub->expects($this->exactly(1))->method('relationshipsFill')->with(
            $relationships['sourceUnits'],
            $includedConversion
        )->willReturn($sourceUnitsArray);
        
        $this->initRelationshipsStaff($staffArray, $staff, $stub);
        $this->initRelationshipsTemplate($directoryTemplateArray, $directoryTemplate, $stub);
        $this->initRelationshipsOrganizationAndSourceUnit(
            $organizationArray,
            $organization,
            $sourceUnitArray,
            $sourceUnit,
            $stub
        );

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\Directory',
            $result
        );

        $this->assertEquals([$sourceUnit], $result->getSourceUnits());
        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($staff, $result->getStaff());
        $this->assertEquals($directoryTemplate, $result->getTemplate());
    }

    private function initRelationshipsStaff($staffArray, $staff, $stub)
    {
        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $staffRestfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $staffRestfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($staffRestfulTranslator->reveal());
    }

    private function initRelationshipsTemplate($directoryTemplateArray, $directoryTemplate, $stub)
    {
        // 为 TemplateRestfulTranslator 类建立预言(prophecy)。
        $templateRestfulTranslator = $this->prophesize(TemplateRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $templateRestfulTranslator->arrayToObject(
            $directoryTemplateArray
        )->shouldBeCalled(1)->willReturn($directoryTemplate);
        // 为 getTemplateRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getTemplateRestfulTranslator'
        )->willReturn($templateRestfulTranslator->reveal());
    }

    private function initRelationshipsOrganizationAndSourceUnit(
        $organizationArray,
        $organization,
        $sourceUnitArray,
        $sourceUnit,
        $stub
    ) {
        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $organizationRestfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $organizationRestfulTranslator->arrayToObject(
            $organizationArray
        )->shouldBeCalled(1)->willReturn($organization);
        $organizationRestfulTranslator->arrayToObject(
            $sourceUnitArray
        )->shouldBeCalled(1)->willReturn($sourceUnit);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(2))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($organizationRestfulTranslator->reveal());
    }

    public function testObjectToArrayEmpty()
    {
        $directory = array();
        $result = $this->stub->objectToArray($directory);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(DirectoryRestfulTranslatorMock::class)
                           ->setMethods([
                               'subjectCategoryMerge',
                               'itemsFormatConversion'
                            ])->getMock();

        $directory = MockObjectGenerate::generateDirectory(1);
        $subjectCategoryMerge = 1;
        $itemsFormatConversion = array('items');

        $stub->expects($this->exactly(1))->method('subjectCategoryMerge')->with(
            $directory->getSubjectCategory()
        )->willReturn($subjectCategoryMerge);

        $stub->expects($this->exactly(1))->method('itemsFormatConversion')->with(
            $directory->getItems()
        )->willReturn($itemsFormatConversion);

        $result = $stub->objectToArray($directory);
        if (isset($result['data']['attributes']['subjectCategory'])) {
            $this->assertEquals($result['data']['attributes']['subjectCategory'], $subjectCategoryMerge);
        }

        if (isset($result['data']['attributes']['items'])) {
            $this->assertEquals($result['data']['attributes']['items'], $itemsFormatConversion);
        }
        $this->compareRestfulTranslatorEquals($directory, $result);
    }

    public function testItemsFormatConversion()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $items = array(
            array(
                'dataType' => 1,
                'dataLength' => 100,
                'required' => 1,
                'desensitization' => Directory::DESENSITIZATION['NO'],
                'publicationRange' => 1,
                'desensitizationRule' => [0, 0]
            )
        );

        $result = $stub->itemsFormatConversionPublic($items);

        $this->assertIsArray($result);
    }

    public function testItemsFormatConversionYes()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $items = array(
            array(
                'dataType' => 1,
                'dataLength' => 100,
                'required' => 1,
                'desensitization' => Directory::DESENSITIZATION['YES'],
                'publicationRange' => 1,
                'desensitizationRule' => [1, 2]
            )
        );

        $result = $stub->itemsFormatConversionPublic($items);

        $this->assertIsArray($result);
    }

    public function testSubjectCategoryMerge()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $subjectCategory = array(1, 2);

        $result = $stub->subjectCategoryMergePublic($subjectCategory);

        $this->assertEquals($result, 3);
    }

    public function testSubjectCategorySplit()
    {
        $stub = new DirectoryRestfulTranslatorMock();
        $subjectCategory = Directory::SUBJECT_CATEGORY['FRJFFRZZ'];

        $result = $stub->subjectCategorySplitPublic($subjectCategory);

        $this->assertEquals($result, array(Directory::SUBJECT_CATEGORY['FRJFFRZZ']));
    }
}

<?php
namespace Sdk\Resource\ExportDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\ExportDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\ExportDataTask\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator;
use Sdk\Resource\Directory\Utils\MockObjectGenerate as DirectoryMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ExportDataTaskRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $exportStub;

    protected function setUp(): void
    {
        $this->exportStub = new ExportDataTaskRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->exportStub);
    }

    public function testImplementsIRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\IRestfulTranslator',
            $this->exportStub
        );
    }

    public function testGetStaffRestfulTranslator()
    {
        $exportStub = new ExportDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $exportStub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $exportStub = new ExportDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $exportStub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testGetSnapshotRestfulTranslator()
    {
        $exportStub = new ExportDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator',
            $exportStub->getSnapshotRestfulTranslatorPublic()
        );
    }

    public function testGetDirectoryRestfulTranslator()
    {
        $exportStub = new ExportDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator',
            $exportStub->getDirectoryRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->exportStub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\NullExportDataTask',
            $result
        );
    }

    public function testArrayToObject()
    {
        $exportDataTask = MockObjectGenerate::generateExportDataTask(1);

        $expression['data']['id'] = $exportDataTask->getId();
        $expression['data']['attributes']['name'] = $exportDataTask->getExportFileName();
        $expression['data']['attributes']['total'] = $exportDataTask->getTotal();
        $expression['data']['attributes']['size'] = $exportDataTask->getSize();
        $expression['data']['attributes']['offset'] = $exportDataTask->getOffset();
        $expression['data']['attributes']['filter'] = $exportDataTask->getFilter();
        $expression['data']['attributes']['sort'] = $exportDataTask->getSort();
        $expression['data']['attributes']['updatedNum'] = $exportDataTask->getUpdatedNum();
        $expression['data']['attributes']['code'] = $exportDataTask->getCode();
        $expression['data']['attributes']['status'] = $exportDataTask->getStatus();
        $expression['data']['attributes']['statusTime'] = $exportDataTask->getStatusTime();
        $expression['data']['attributes']['createTime'] = $exportDataTask->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $exportDataTask->getUpdateTime();

        $result = $this->exportStub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\ExportDataTask',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $exportStub = $this->getMockBuilder(ExportDataTaskRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getOrganizationRestfulTranslator',
                               'getStaffRestfulTranslator',
                               'getDirectoryRestfulTranslator',
                               'getSnapshotRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'directorySnapshot' => array('directorySnapshot'),
            'organization' => array('organization'),
            'directory' => array('directory'),
            'staff' => array('staff')
        );

        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');

        $directorySnapshotArray = array('directorySnapshotArray');
        $directorySnapshot = DirectoryMockObjectGenerate::generateSnapshot(1);

        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);

        $directoryArray = array('directoryArray');
        $directory = DirectoryMockObjectGenerate::generateDirectory(1);

        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);
        
        $exportStub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $exportStub->expects($this->exactly(4))->method('relationshipFill')
            ->will($this->returnValueMap([
                [
                    $relationships['directorySnapshot'], $includedConversion, $directorySnapshotArray
                ],
                [
                    $relationships['organization'], $includedConversion, $organizationArray
                ],
                [
                    $relationships['directory'], $includedConversion, $directoryArray
                ],
                [
                    $relationships['staff'], $includedConversion, $staffArray
                ]
            ]));
        
        $this->initRelationshipsStaff($staffArray, $staff, $exportStub);
        $this->initRelationshipsDirectory($directoryArray, $directory, $exportStub);
        $this->initRelationshipsOrganization($organizationArray, $organization, $exportStub);
        $this->initRelationshipsDirectorySnapshot($directorySnapshotArray, $directorySnapshot, $exportStub);

        $result = $exportStub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\ExportDataTask',
            $result
        );

        $this->assertEquals($staff, $result->getStaff());
        $this->assertEquals($directory, $result->getDirectory());
        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($directorySnapshot, $result->getDirectorySnapshot());
    }

    private function initRelationshipsOrganization($organizationArray, $organization, $exportStub)
    {
        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($organizationArray)->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());
    }

    private function initRelationshipsDirectory($directoryArray, $directory, $exportStub)
    {
        // 为 DirectoryRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(DirectoryRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($directoryArray)->shouldBeCalled(1)->willReturn($directory);
        // 为 getDirectoryRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getDirectoryRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());
    }

    private function initRelationshipsDirectorySnapshot($directorySnapshotArray, $directorySnapshot, $exportStub)
    {
        // 为 SnapshotRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(SnapshotRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($directorySnapshotArray)->shouldBeCalled(1)->willReturn($directorySnapshot);
        // 为 getSnapshotRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getSnapshotRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());
    }

    private function initRelationshipsStaff($staffArray, $staff, $exportStub)
    {
        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());
    }

    public function testObjectToArrayEmpty()
    {
        $exportDataTask = array();
        $result = $this->exportStub->objectToArray($exportDataTask);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $exportDataTask = MockObjectGenerate::generateExportDataTask(1);
 
        $result = $this->exportStub->objectToArray($exportDataTask);
        
        $this->compareRestfulTranslatorEquals($exportDataTask, $result);
    }
}

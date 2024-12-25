<?php
namespace Sdk\Resource\ExportDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\ExportDataTask\Model\ExportDataTask;
use Sdk\Resource\ExportDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\ExportDataTask\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Resource\Directory\Translator\DirectoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ExportDataTaskTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $exportStub;

    protected function setUp(): void
    {
        $this->exportStub = new ExportDataTaskTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->exportStub);
    }

    public function testImplementsITranslator()
    {
        $this->assertInstanceOf(
            'Marmot\Interfaces\ITranslator',
            $this->exportStub
        );
    }

    public function testGetStaffTranslator()
    {
        $exportStub = new ExportDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $exportStub->getStaffTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $exportStub = new ExportDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $exportStub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetSnapshotTranslator()
    {
        $exportStub = new ExportDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotTranslator',
            $exportStub->getSnapshotTranslatorPublic()
        );
    }

    public function testGetDirectoryTranslator()
    {
        $exportStub = new ExportDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryTranslator',
            $exportStub->getDirectoryTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $exportStub = new ExportDataTaskTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\ExportDataTask\Model\NullExportDataTask',
            $exportStub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $exportDataTask = array();
        $result = $this->exportStub->objectToArray($exportDataTask);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $exportStub = $this->getMockBuilder(ExportDataTaskTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'getOrganizationTranslator',
                               'getDirectoryTranslator',
                               'getSnapshotTranslator',
                               'getStaffTranslator'
                            ])->getMock();

        $exportDataTask = MockObjectGenerate::generateExportDataTask(1);

        list(
            $organizationArray,
            $directoryArray,
            $directorySnapshotArray,
            $staffArray
        ) = $this->relationObjectToArray($exportDataTask, $exportStub);

        $codeArray = $this->typeFormatConversion($exportDataTask, $exportStub);
        $statusArray = $this->statusFormatConversion($exportDataTask, $exportStub);
 
        $result = $exportStub->objectToArray($exportDataTask);

        $this->assertEquals($result['code'], $codeArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['staff'], $staffArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['directory'], $directoryArray);
        $this->assertEquals($result['directorySnapshot'], $directorySnapshotArray);
        
        $this->compareTranslatorEquals($result, $exportDataTask);
    }

    private function typeFormatConversion(ExportDataTask $exportDataTask, $exportStub) : array
    {
        unset($exportDataTask);
        $codeArray = array('code');
        $exportStub->expects($this->once())->method('typeFormatConversion')->willReturn($codeArray);

        return $codeArray;
    }

    private function statusFormatConversion(ExportDataTask $exportDataTask, $exportStub) : array
    {
        unset($exportDataTask);
        $statusArray = array('status');

        $exportStub->expects($this->once())->method('statusFormatConversion')->willReturn($statusArray);

        return $statusArray;
    }

    private function relationObjectToArray(ExportDataTask $exportDataTask, $exportStub) : array
    {
        $organizationArray = $this->organizationRelationObjectToArray($exportDataTask, $exportStub);
        $staffArray = $this->staffRelationObjectToArray($exportDataTask, $exportStub);
        $directoryArray = $this->directoryRelationObjectToArray($exportDataTask, $exportStub);
        $directorySnapshotArray = $this->directorySnapshotRelationObjectToArray($exportDataTask, $exportStub);

        return [$organizationArray, $directoryArray, $directorySnapshotArray, $staffArray];
    }

    private function organizationRelationObjectToArray(ExportDataTask $exportDataTask, $exportStub) : array
    {
        $organization = $exportDataTask->getOrganization();
        $organizationArray = array('organizationArray');

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $organizationTranslator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $organizationTranslator->objectToArray(
            $organization,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($organizationArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($organizationTranslator->reveal());

        return $organizationArray;
    }

    private function staffRelationObjectToArray(ExportDataTask $exportDataTask, $exportStub) : array
    {
        $staff = $exportDataTask->getStaff();
        $staffArray = array('staffArray');

        // 为 StaffTranslator 类建立预言(prophecy)。
        $staffTranslator = $this->prophesize(StaffTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $staffTranslator->objectToArray(
            $staff,
            ['id', 'subjectName']
        )->shouldBeCalled(1)->willReturn($staffArray);
        // 为 getStaffTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getStaffTranslator'
        )->willReturn($staffTranslator->reveal());

        return $staffArray;
    }

    private function directoryRelationObjectToArray(ExportDataTask $exportDataTask, $exportStub) : array
    {
        $directory = $exportDataTask->getDirectory();
        $directoryArray = array('directoryArray');

        // 为 DirectoryTranslator 类建立预言(prophecy)。
        $directoryTranslator = $this->prophesize(DirectoryTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $directoryTranslator->objectToArray(
            $directory,
            ['id', 'name', 'items']
        )->shouldBeCalled(1)->willReturn($directoryArray);
        // 为 getDirectoryTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getDirectoryTranslator'
        )->willReturn($directoryTranslator->reveal());

        return $directoryArray;
    }

    private function directorySnapshotRelationObjectToArray(ExportDataTask $exportDataTask, $exportStub) : array
    {
        $directorySnapshot = $exportDataTask->getDirectorySnapshot();
        $directorySnapshotArray = array('directorySnapshotArray');

        // 为 SnapshotTranslator 类建立预言(prophecy)。
        $snapshotTranslator = $this->prophesize(SnapshotTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $snapshotTranslator->objectToArray(
            $directorySnapshot,
            ['id', 'name', 'items']
        )->shouldBeCalled(1)->willReturn($directorySnapshotArray);
        // 为 getSnapshotTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $exportStub->expects($this->exactly(1))->method(
            'getSnapshotTranslator'
        )->willReturn($snapshotTranslator->reveal());

        return $directorySnapshotArray;
    }
}

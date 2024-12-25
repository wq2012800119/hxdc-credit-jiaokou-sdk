<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\UploadDataTask\Model\UploadDataTask;
use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\UploadDataTask\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Resource\Directory\Translator\DirectoryTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class UploadDataTaskTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new UploadDataTaskTranslator();
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
        $stub = new UploadDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $stub->getStaffTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $stub = new UploadDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetSnapshotTranslator()
    {
        $stub = new UploadDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotTranslator',
            $stub->getSnapshotTranslatorPublic()
        );
    }

    public function testGetDirectoryTranslator()
    {
        $stub = new UploadDataTaskTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryTranslator',
            $stub->getDirectoryTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new UploadDataTaskTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\NullUploadDataTask',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $uploadDataTask = array();
        $result = $this->stub->objectToArray($uploadDataTask);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(UploadDataTaskTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'taskStatusFormatConversion',
                               'getOrganizationTranslator',
                               'getDirectoryTranslator',
                               'getSnapshotTranslator',
                               'getStaffTranslator'
                            ])->getMock();

        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);

        list(
            $organizationArray,
            $directoryArray,
            $directorySnapshotArray,
            $staffArray
        ) = $this->relationObjectToArray($uploadDataTask, $stub);

        $codeArray = $this->typeFormatConversion($uploadDataTask, $stub);
        list($statusArray, $executionStatusArray) = $this->statusFormatConversion($uploadDataTask, $stub);
 
        $result = $stub->objectToArray($uploadDataTask);

        $this->assertEquals($result['code'], $codeArray);
        $this->assertEquals($result['executionStatus'], $executionStatusArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['directory'], $directoryArray);
        $this->assertEquals($result['directorySnapshot'], $directorySnapshotArray);
        $this->assertEquals($result['staff'], $staffArray);
        
        $this->compareTranslatorEquals($result, $uploadDataTask);
    }

    private function typeFormatConversion(UploadDataTask $uploadDataTask, $stub) : array
    {
        unset($uploadDataTask);
        $codeArray = array('code');
        $stub->expects($this->once())->method('typeFormatConversion')->willReturn($codeArray);

        return $codeArray;
    }

    private function statusFormatConversion(UploadDataTask $uploadDataTask, $stub) : array
    {
        unset($uploadDataTask);
        $statusArray = array('status');
        $executionStatusArray = array('executionStatus');

        $stub->expects($this->once())->method('statusFormatConversion')->willReturn($executionStatusArray);
        $stub->expects($this->once())->method('taskStatusFormatConversion')->willReturn($statusArray);

        return [$statusArray, $executionStatusArray];
    }

    private function relationObjectToArray(UploadDataTask $uploadDataTask, $stub) : array
    {
        $organizationArray = $this->organizationRelationObjectToArray($uploadDataTask, $stub);
        $staffArray = $this->staffRelationObjectToArray($uploadDataTask, $stub);
        $directoryArray = $this->directoryRelationObjectToArray($uploadDataTask, $stub);
        $directorySnapshotArray = $this->directorySnapshotRelationObjectToArray($uploadDataTask, $stub);

        return [$organizationArray, $directoryArray, $directorySnapshotArray, $staffArray];
    }

    private function organizationRelationObjectToArray(UploadDataTask $uploadDataTask, $stub) : array
    {
        $organization = $uploadDataTask->getOrganization();
        $organizationArray = array('organizationArray');

        // 为 OrganizationTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $organization,
            ['id', 'name']
        )->shouldBeCalled(1)->willReturn($organizationArray);
        // 为 getOrganizationTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationTranslator'
        )->willReturn($translator->reveal());

        return $organizationArray;
    }

    private function staffRelationObjectToArray(UploadDataTask $uploadDataTask, $stub) : array
    {
        $staff = $uploadDataTask->getStaff();
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

    private function directoryRelationObjectToArray(UploadDataTask $uploadDataTask, $stub) : array
    {
        $directory = $uploadDataTask->getDirectory();
        $directoryArray = array('directoryArray');

        // 为 DirectoryTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(DirectoryTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $directory,
            ['id', 'name', 'items']
        )->shouldBeCalled(1)->willReturn($directoryArray);
        // 为 getDirectoryTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDirectoryTranslator'
        )->willReturn($translator->reveal());

        return $directoryArray;
    }

    private function directorySnapshotRelationObjectToArray(UploadDataTask $uploadDataTask, $stub) : array
    {
        $directorySnapshot = $uploadDataTask->getDirectorySnapshot();
        $directorySnapshotArray = array('directorySnapshotArray');

        // 为 SnapshotTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(SnapshotTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $directorySnapshot,
            ['id', 'name', 'items']
        )->shouldBeCalled(1)->willReturn($directorySnapshotArray);
        // 为 getSnapshotTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getSnapshotTranslator'
        )->willReturn($translator->reveal());

        return $directorySnapshotArray;
    }

    public function testTaskStatusFormatConversionFailed()
    {
        $stub = $this->getMockBuilder(UploadDataTaskTranslatorMock::class)
                           ->setMethods([
                               'statusFormatConversion'
                            ])->getMock();

        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);
        $executionStatus = UploadDataTask::EXECUTION_STATUS['FAILED'];
        $uploadDataTask->setExecutionStatus($executionStatus);
        $statusArray = array('statusArray');
        
        $stub->expects($this->once())->method('statusFormatConversion')->willReturn($statusArray);

        $result = $stub->taskStatusFormatConversionPublic($uploadDataTask);

        $this->assertEquals($result, $statusArray);
    }

    public function testTaskStatusFormatConversionCompletedFailed()
    {
        $stub = $this->getMockBuilder(UploadDataTaskTranslatorMock::class)
                           ->setMethods([
                               'statusFormatConversion'
                            ])->getMock();

        $statusArray = array('statusArray');
        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);
        $executionStatus = UploadDataTask::EXECUTION_STATUS['COMPLETED'];
        $total = 1;
        $successNum = 2;
        $uploadDataTask->setExecutionStatus($executionStatus);
        $uploadDataTask->setTotal($total);
        $uploadDataTask->setSuccessNum($successNum);
        
        $stub->expects($this->once())->method('statusFormatConversion')->willReturn($statusArray);

        $result = $stub->taskStatusFormatConversionPublic($uploadDataTask);

        $this->assertEquals($result, $statusArray);
    }

    public function testTaskStatusFormatConversionCompleted()
    {
        $stub = $this->getMockBuilder(UploadDataTaskTranslatorMock::class)
                           ->setMethods([
                               'statusFormatConversion'
                            ])->getMock();

        $statusArray = array('statusArray');
        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);
        $executionStatus = UploadDataTask::EXECUTION_STATUS['COMPLETED'];
        $total = $successNum = 1;
        $uploadDataTask->setTotal($total);
        $uploadDataTask->setSuccessNum($successNum);
        $uploadDataTask->setExecutionStatus($executionStatus);
        
        $stub->expects($this->once())->method('statusFormatConversion')->willReturn($statusArray);

        $result = $stub->taskStatusFormatConversionPublic($uploadDataTask);

        $this->assertEquals($result, $statusArray);
    }
}

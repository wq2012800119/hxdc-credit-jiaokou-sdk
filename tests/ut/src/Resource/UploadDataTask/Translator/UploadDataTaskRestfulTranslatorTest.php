<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\UploadDataTask\Utils\TranslatorUtilsTrait;

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
class UploadDataTaskRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new UploadDataTaskRestfulTranslator();
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
        $stub = new UploadDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new UploadDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testGetSnapshotRestfulTranslator()
    {
        $stub = new UploadDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator',
            $stub->getSnapshotRestfulTranslatorPublic()
        );
    }

    public function testGetDirectoryRestfulTranslator()
    {
        $stub = new UploadDataTaskRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator',
            $stub->getDirectoryRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\NullUploadDataTask',
            $result
        );
    }

    public function testArrayToObject()
    {
        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);

        $expression['data']['id'] = $uploadDataTask->getId();
        $expression['data']['attributes']['name'] = $uploadDataTask->getName();
        $expression['data']['attributes']['exportFileName'] = $uploadDataTask->getExportFileName();
        $expression['data']['attributes']['total'] = $uploadDataTask->getTotal();
        $expression['data']['attributes']['successNum'] = $uploadDataTask->getSuccessNum();
        $expression['data']['attributes']['updatedNum'] = $uploadDataTask->getUpdatedNum();
        $expression['data']['attributes']['code'] = $uploadDataTask->getCode();
        $expression['data']['attributes']['status'] = $uploadDataTask->getStatus();
        $expression['data']['attributes']['statusTime'] = $uploadDataTask->getStatusTime();
        $expression['data']['attributes']['createTime'] = $uploadDataTask->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $uploadDataTask->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTask',
            $result
        );

        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(UploadDataTaskRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getOrganizationRestfulTranslator',
                               'getStaffRestfulTranslator',
                               'getDirectoryRestfulTranslator',
                               'getSnapshotRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'organization' => array('organization'),
            'directory' => array('directory'),
            'directorySnapshot' => array('directorySnapshot'),
            'staff' => array('staff')
        );

        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');

        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);

        $staffArray = array('staffArray');
        $staff = StaffMockObjectGenerate::generateStaff(1);

        $directoryArray = array('directoryArray');
        $directory = DirectoryMockObjectGenerate::generateDirectory(1);

        $directorySnapshotArray = array('directorySnapshotArray');
        $directorySnapshot = DirectoryMockObjectGenerate::generateSnapshot(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(4))->method('relationshipFill')
            ->will($this->returnValueMap([
                [
                    $relationships['organization'], $includedConversion, $organizationArray
                ],
                [
                    $relationships['directory'], $includedConversion, $directoryArray
                ],
                [
                    $relationships['directorySnapshot'], $includedConversion, $directorySnapshotArray
                ],
                [
                    $relationships['staff'], $includedConversion, $staffArray
                ]
            ]));
        
        $this->initRelationshipsStaff($staffArray, $staff, $stub);
        $this->initRelationshipsOrganization($organizationArray, $organization, $stub);
        $this->initRelationshipsDirectory($directoryArray, $directory, $stub);
        $this->initRelationshipsDirectorySnapshot($directorySnapshotArray, $directorySnapshot, $stub);

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTask',
            $result
        );

        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($staff, $result->getStaff());
        $this->assertEquals($directory, $result->getDirectory());
        $this->assertEquals($directorySnapshot, $result->getDirectorySnapshot());
    }

    private function initRelationshipsOrganization($organizationArray, $organization, $stub)
    {
        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($organizationArray)->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($translator->reveal());
    }

    private function initRelationshipsDirectory($directoryArray, $directory, $stub)
    {
        // 为 DirectoryRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(DirectoryRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($directoryArray)->shouldBeCalled(1)->willReturn($directory);
        // 为 getDirectoryRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getDirectoryRestfulTranslator'
        )->willReturn($translator->reveal());
    }

    private function initRelationshipsDirectorySnapshot($directorySnapshotArray, $directorySnapshot, $stub)
    {
        // 为 SnapshotRestfulTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(SnapshotRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->arrayToObject($directorySnapshotArray)->shouldBeCalled(1)->willReturn($directorySnapshot);
        // 为 getSnapshotRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getSnapshotRestfulTranslator'
        )->willReturn($translator->reveal());
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

    public function testObjectToArrayEmpty()
    {
        $uploadDataTask = array();
        $result = $this->stub->objectToArray($uploadDataTask);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $uploadDataTask = MockObjectGenerate::generateUploadDataTask(1);
 
        $result = $this->stub->objectToArray($uploadDataTask);
        
        $this->compareRestfulTranslatorEquals($uploadDataTask, $result);
    }
}

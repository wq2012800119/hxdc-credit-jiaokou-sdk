<?php
namespace Sdk\Resource\Data\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Data\Model\Data;
use Sdk\Resource\Data\Utils\MockObjectGenerate;
use Sdk\Resource\Data\Utils\TranslatorUtilsTrait;

use Sdk\User\Staff\Translator\StaffRestfulTranslator;
use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;

use Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

use Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator;
use Sdk\Resource\Directory\Utils\MockObjectGenerate as DirectoryMockObjectGenerate;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DataRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DataRestfulTranslator();
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
        $stub = new DataRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffRestfulTranslator',
            $stub->getStaffRestfulTranslatorPublic()
        );
    }

    public function testGetSnapshotRestfulTranslator()
    {
        $stub = new DataRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotRestfulTranslator',
            $stub->getSnapshotRestfulTranslatorPublic()
        );
    }

    public function testGetOrganizationRestfulTranslator()
    {
        $stub = new DataRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationRestfulTranslator',
            $stub->getOrganizationRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\Data\Model\NullData',
            $result
        );
    }

    public function testArrayToObject()
    {
        $data = MockObjectGenerate::generateData(1);

        $expression['data']['id'] = $data->getId();
        $expression['data']['attributes']['subjectName'] = $data->getSubjectName();
        $expression['data']['attributes']['identify'] = $data->getIdentify();
        $expression['data']['attributes']['subjectCategory'] = $data->getSubjectCategory();
        $expression['data']['attributes']['infoCategory'] = $data->getInfoCategory();
        $expression['data']['attributes']['publicationRange'] = $data->getPublicationRange();
        $expression['data']['attributes']['expireDate'] = $data->getExpireDate();
        $expression['data']['attributes']['exchangeSyncStatus'] = $data->getExchangeSyncStatus();
        $expression['data']['attributes']['internalSyncStatus'] = $data->getInternalSyncStatus();
        $expression['data']['attributes']['items'] = $data->getItems();
        $expression['data']['attributes']['examineStatus'] = $data->getExamineStatus();
        $expression['data']['attributes']['status'] = $data->getStatus();
        $expression['data']['attributes']['statusTime'] = $data->getStatusTime();
        $expression['data']['attributes']['createTime'] = $data->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $data->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf('Sdk\Resource\Data\Model\Data', $result);
        $this->compareRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(DataRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getOrganizationRestfulTranslator',
                               'getStaffRestfulTranslator',
                               'getSnapshotRestfulTranslator'
                            ])->getMock();

        $relationships = array(
            'organization' => array('organization'),
            'staff' => array('staff'),
            'directorySnapshot' => array('directorySnapshot')
        );
        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
    
        $organizationArray = array('organizationArray');
        $organization = OrganizationMockObjectGenerate::generateOrganization(1);

        $directorySnapshotArray = array('directorySnapshotArray');
        $directorySnapshot = DirectoryMockObjectGenerate::generateSnapshot(1);

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
                    $relationships['directorySnapshot'], $includedConversion, $directorySnapshotArray
                ]
            ]));
            
        
        // 为 StaffRestfulTranslator 类建立预言(prophecy)。
        $staffRestfulTranslator = $this->prophesize(StaffRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $staffRestfulTranslator->arrayToObject($staffArray)->shouldBeCalled(1)->willReturn($staff);
        // 为 getStaffRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getStaffRestfulTranslator'
        )->willReturn($staffRestfulTranslator->reveal());

        // 为 SnapshotRestfulTranslator 类建立预言(prophecy)。
        $snapshotRestfulTranslator = $this->prophesize(SnapshotRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $snapshotRestfulTranslator->arrayToObject(
            $directorySnapshotArray
        )->shouldBeCalled(1)->willReturn($directorySnapshot);
        // 为 getSnapshotRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getSnapshotRestfulTranslator'
        )->willReturn($snapshotRestfulTranslator->reveal());

        // 为 OrganizationRestfulTranslator 类建立预言(prophecy)。
        $organizationRestfulTranslator = $this->prophesize(OrganizationRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $organizationRestfulTranslator->arrayToObject(
            $organizationArray
        )->shouldBeCalled(1)->willReturn($organization);
        // 为 getOrganizationRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getOrganizationRestfulTranslator'
        )->willReturn($organizationRestfulTranslator->reveal());

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Resource\Data\Model\Data',
            $result
        );

        $this->assertEquals($organization, $result->getOrganization());
        $this->assertEquals($directorySnapshot, $result->getDirectorySnapshot());
        $this->assertEquals($staff, $result->getStaff());
    }

    public function testObjectToArrayEmpty()
    {
        $data = array();
        $result = $this->stub->objectToArray($data);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $data = MockObjectGenerate::generateData(1);

        $result = $this->stub->objectToArray($data);
        $this->compareRestfulTranslatorEquals($data, $result);
    }
}

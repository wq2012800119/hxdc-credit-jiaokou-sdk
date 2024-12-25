<?php
namespace Sdk\Resource\Data\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Common\Model\Interfaces\IOperateAble;
use Sdk\Common\Model\Interfaces\IExamineAble;

use Sdk\Resource\Data\Model\Data;
use Sdk\Resource\Data\Utils\MockObjectGenerate;
use Sdk\Resource\Data\Utils\TranslatorUtilsTrait;

use Sdk\Resource\Directory\Model\Directory;
use Sdk\User\Staff\Translator\StaffTranslator;
use Sdk\Resource\Directory\Translator\SnapshotTranslator;
use Sdk\Organization\Organization\Translator\OrganizationTranslator;

class DataTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new DataTranslator();
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
        $stub = new DataTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\User\Staff\Translator\StaffTranslator',
            $stub->getStaffTranslatorPublic()
        );
    }

    public function testGetSnapshotTranslator()
    {
        $stub = new DataTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\SnapshotTranslator',
            $stub->getSnapshotTranslatorPublic()
        );
    }

    public function testGetOrganizationTranslator()
    {
        $stub = new DataTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Organization\Organization\Translator\OrganizationTranslator',
            $stub->getOrganizationTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new DataTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\Data\Model\NullData',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $data = array();
        $result = $this->stub->objectToArray($data);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(DataTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'statusFormatConversion',
                               'getOrganizationTranslator',
                               'getStaffTranslator',
                               'getSnapshotTranslator'
                            ])->getMock();

        $data = MockObjectGenerate::generateData(1);
        $data->setSubjectCategory(Directory::SUBJECT_CATEGORY['FRJFFRZZ']);
        $data->setInfoCategory(Directory::INFO_CATEGORY['CSSX']);
        $data->setPublicationRange(Directory::PUBLICATION_RANGE['SHGK']);

        list(
            $directorySnapshotArray,
            $organizationArray,
            $staffArray
        ) = $this->relationObjectToArray($data, $stub);

        list(
            $subjectCategoryArray,
            $infoCategoryArray,
            $publicationRangeArray
        ) = $this->typeFormatConversion($data, $stub);
        list($statusArray, $examineStatusArray) = $this->statusFormatConversion($data, $stub);
 
        $result = $stub->objectToArray($data);

        $this->assertEquals($result['publicationRange'], $publicationRangeArray);
        $this->assertEquals($result['subjectCategory'], $subjectCategoryArray);
        $this->assertEquals($result['infoCategory'], $infoCategoryArray);
        $this->assertEquals($result['status'], $statusArray);
        $this->assertEquals($result['examineStatus'], $examineStatusArray);
        $this->assertEquals($result['directorySnapshot'], $directorySnapshotArray);
        $this->assertEquals($result['organization'], $organizationArray);
        $this->assertEquals($result['staff'], $staffArray);
        
        $this->compareTranslatorEquals($result, $data);
    }

    private function typeFormatConversion(Data $data, $stub) : array
    {
        $subjectCategoryArray = array('subjectCategory');
        $infoCategoryArray = array('infoCategory');
        $publicationRangeArray = array('publicationRangeArray');

        $stub->expects($this->exactly(3))->method('typeFormatConversion')
            ->will($this->returnValueMap([
                [
                    $data->getSubjectCategory(), Directory::SUBJECT_CATEGORY_CN, $subjectCategoryArray
                ],
                [
                    $data->getInfoCategory(), Directory::INFO_CATEGORY_CN, $infoCategoryArray
                ],
                [
                    $data->getPublicationRange(), Directory::PUBLICATION_RANGE_CN, $publicationRangeArray
                ]
            ]));

        return [$subjectCategoryArray, $infoCategoryArray, $publicationRangeArray];
    }

    private function statusFormatConversion(Data $data, $stub) : array
    {
        $statusArray = array('status');
        $examineStatusArray = array('examineStatus');
        $stub->expects($this->exactly(2))->method('statusFormatConversion')
            ->will($this->returnValueMap([
                [
                    $data->getStatus(), IOperateAble::STATUS_TYPE, Data::DATA_STATUS_CN, $statusArray
                ],
                [
                    $data->getExamineStatus(),
                    IExamineAble::EXAMINE_STATUS_TYPE,
                    IExamineAble::EXAMINE_STATUS_CN,
                    $examineStatusArray
                ]
            ]));

        return [$statusArray, $examineStatusArray];
    }

    private function relationObjectToArray(Data $data, $stub) : array
    {
        $organizationArray = $this->organizationRelationObjectToArray($data, $stub);
        $staffArray = $this->staffRelationObjectToArray($data, $stub);
        $directorySnapshotArray = $this->directorySnapshotRelationObjectToArray($data, $stub);

        return [$directorySnapshotArray, $organizationArray, $staffArray];
    }

    private function organizationRelationObjectToArray(Data $data, $stub) : array
    {
        $organization = $data->getOrganization();
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

    private function staffRelationObjectToArray(Data $data, $stub) : array
    {
        $staff = $data->getStaff();
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

    private function directorySnapshotRelationObjectToArray(Data $data, $stub) : array
    {
        $snapshot = $data->getDirectorySnapshot();
        $snapshotArray = array('snapshotArray');

        // 为 SnapshotTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(SnapshotTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $snapshot,
            ['id', 'name', 'directoryId', 'items', 'version', 'versionDescription']
        )->shouldBeCalled(1)->willReturn($snapshotArray);
        // 为 getSnapshotTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getSnapshotTranslator'
        )->willReturn($translator->reveal());

        return $snapshotArray;
    }
}

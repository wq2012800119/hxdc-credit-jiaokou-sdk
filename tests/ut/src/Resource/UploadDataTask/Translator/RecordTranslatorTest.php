<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\UploadDataTask\Utils\TranslatorUtilsTrait;
use Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord;

class RecordTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RecordTranslator();
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

    public function testGetUploadDataTaskTranslator()
    {
        $stub = new RecordTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Translator\UploadDataTaskTranslator',
            $stub->getUploadDataTaskTranslatorPublic()
        );
    }

    public function testGetNullObject()
    {
        $stub = new RecordTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\NullUploadDataTaskRecord',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $record = array();
        $result = $this->stub->objectToArray($record);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $stub = $this->getMockBuilder(RecordTranslatorMock::class)
                           ->setMethods([
                               'typeFormatConversion',
                               'getUploadDataTaskTranslator'
                            ])->getMock();

        $record = MockObjectGenerate::generateRecord(1);
        $uploadDataTaskArray = $this->relationObjectToArray($record, $stub);
        $errorNumberArray = $this->typeFormatConversion($record, $stub);
 
        $result = $stub->objectToArray($record);

        $this->assertEquals($result['errorNumber'], $errorNumberArray);
        $this->assertEquals($result['uploadDataTask'], $uploadDataTaskArray);
        
        $this->compareRecordTranslatorEquals($result, $record);
    }

    private function typeFormatConversion(UploadDataTaskRecord $record, $stub) : array
    {
        unset($record);
        $errorNumberArray = array('errorNumber');
        $stub->expects($this->once())->method('typeFormatConversion')->willReturn($errorNumberArray);

        return $errorNumberArray;
    }

    private function relationObjectToArray(UploadDataTaskRecord $record, $stub) : array
    {
        $task = $record->getUploadDataTask();
        $taskArray = array('taskArray');

        // 为 UploadDataTaskTranslator 类建立预言(prophecy)。
        $translator = $this->prophesize(UploadDataTaskTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $translator->objectToArray(
            $task,
            ['id', 'name', 'exportFileName', 'directory' => [], 'directorySnapshot' =>[]]
        )->shouldBeCalled(1)->willReturn($taskArray);
        // 为 getUploadDataTaskTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getUploadDataTaskTranslator'
        )->willReturn($translator->reveal());

        return $taskArray;
    }
}

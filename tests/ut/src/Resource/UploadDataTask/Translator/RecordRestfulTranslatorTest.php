<?php
namespace Sdk\Resource\UploadDataTask\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\UploadDataTask\Utils\MockObjectGenerate;
use Sdk\Resource\UploadDataTask\Utils\TranslatorUtilsTrait;

/**
 * @todo
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RecordRestfulTranslatorTest extends TestCase
{
    use TranslatorUtilsTrait;
    
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new RecordRestfulTranslator();
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

    public function testGetUploadDataTaskRestfulTranslator()
    {
        $stub = new RecordRestfulTranslatorMock();
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Translator\UploadDataTaskRestfulTranslator',
            $stub->getUploadDataTaskRestfulTranslatorPublic()
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\NullUploadDataTaskRecord',
            $result
        );
    }

    public function testArrayToObject()
    {
        $record = MockObjectGenerate::generateRecord(1);

        $expression['data']['id'] = $record->getId();
        $expression['data']['attributes']['index'] = $record->getIndex();
        $expression['data']['attributes']['items'] = $record->getItems();
        $expression['data']['attributes']['errorDescription'] = $record->getErrorDescription();
        $expression['data']['attributes']['failReason'] = $record->getFailReason();
        $expression['data']['attributes']['errorNumber'] = $record->getErrorNumber();
        $expression['data']['attributes']['status'] = $record->getStatus();
        $expression['data']['attributes']['statusTime'] = $record->getStatusTime();
        $expression['data']['attributes']['createTime'] = $record->getCreateTime();
        $expression['data']['attributes']['updateTime'] = $record->getUpdateTime();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord',
            $result
        );

        $this->compareRecordRestfulTranslatorEquals($result, $expression);
    }

    public function testArrayToObjectRelationships()
    {
        $stub = $this->getMockBuilder(RecordRestfulTranslatorMock::class)
                           ->setMethods([
                               'includedFormatConversion',
                               'relationshipFill',
                               'getUploadDataTaskRestfulTranslator'
                            ])->getMock();

        $relationships = array('task' => array('task'));

        $included = array('included');
        $expression['data']['relationships'] = $relationships;
        $expression['included'] = $included;

        $includedConversion = array('includedConversion');
        $taskArray = array('taskArray');
        $task = MockObjectGenerate::generateUploadDataTask(1);

        $stub->expects($this->exactly(1))->method(
            'includedFormatConversion'
        )->with($included)->willReturn($includedConversion);

        $stub->expects($this->exactly(1))->method(
            'relationshipFill'
        )->with($relationships['task'], $includedConversion)->willReturn($taskArray);
        
        $this->initRelationshipsTask($taskArray, $task, $stub);

        $result = $stub->arrayToObject($expression);
        $this->assertInstanceOf(
            'Sdk\Resource\UploadDataTask\Model\UploadDataTaskRecord',
            $result
        );

        $this->assertEquals($task, $result->getUploadDataTask());
    }

    private function initRelationshipsTask($taskArray, $task, $stub)
    {
        // 为 UploadDataTaskRestfulTranslator 类建立预言(prophecy)。
        $restfulTranslator = $this->prophesize(UploadDataTaskRestfulTranslator::class);
        // 建立预期状况:method() 方法将会被调用一次。
        $restfulTranslator->arrayToObject($taskArray)->shouldBeCalled(1)->willReturn($task);
        // 为 getUploadDataTaskRestfulTranslator() 方法建立预期：该方法被调用一次,返回揭示预言。
        $stub->expects($this->exactly(1))->method(
            'getUploadDataTaskRestfulTranslator'
        )->willReturn($restfulTranslator->reveal());
    }

    public function testObjectToArrayEmpty()
    {
        $record = array();
        $result = $this->stub->objectToArray($record);

        $this->assertEmpty($result);
    }
}

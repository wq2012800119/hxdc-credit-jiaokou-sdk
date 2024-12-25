<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Utils\MockObjectGenerate;

class SnapshotRestfulTranslatorTest extends TestCase
{

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SnapshotRestfulTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsDirectoryRestfulTranslator()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryRestfulTranslator',
            $this->stub
        );
    }

    public function testArrayToObjectEmpty()
    {
        $result = $this->stub->arrayToObject([]);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullDirectorySnapshot',
            $result
        );
    }

    public function testArrayToObject()
    {
        $snapshot = MockObjectGenerate::generateSnapshot(1);

        $expression['data']['attributes']['directoryId'] = $snapshot->getDirectoryId();

        $result = $this->stub->arrayToObject($expression);

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\DirectorySnapshot',
            $result
        );

        $this->assertEquals($result->getDirectoryId(), $snapshot->getDirectoryId());
    }

    public function testObjectToArrayEmpty()
    {
        $snapshot = array();
        $result = $this->stub->objectToArray($snapshot);

        $this->assertEmpty($result);
    }
}

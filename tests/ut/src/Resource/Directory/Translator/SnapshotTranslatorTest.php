<?php
namespace Sdk\Resource\Directory\Translator;

use PHPUnit\Framework\TestCase;

use Sdk\Resource\Directory\Utils\MockObjectGenerate;

class SnapshotTranslatorTest extends TestCase
{

    private $stub;

    protected function setUp(): void
    {
        $this->stub = new SnapshotTranslator();
    }

    protected function tearDown(): void
    {
        unset($this->stub);
    }

    public function testExtendsDirectoryTranslator()
    {
        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Translator\DirectoryTranslator',
            $this->stub
        );
    }

    public function testGetNullObject()
    {
        $stub = new SnapshotTranslatorMock();

        $this->assertInstanceOf(
            'Sdk\Resource\Directory\Model\NullDirectorySnapshot',
            $stub->getNullObjectPublic()
        );
    }

    public function testObjectToArrayEmpty()
    {
        $snapshot = array();
        $result = $this->stub->objectToArray($snapshot);

        $this->assertEmpty($result);
    }

    public function testObjectToArray()
    {
        $snapshot = MockObjectGenerate::generateSnapshot(1);

        $result = $this->stub->objectToArray($snapshot, array('directoryId'));

        $this->assertEquals($result['directoryId'], marmot_encode($snapshot->getDirectoryId()));
    }
}
